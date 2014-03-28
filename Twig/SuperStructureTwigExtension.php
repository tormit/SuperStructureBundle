<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/28/14 4:20 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Twig;


use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Tormit\Bundle\SuperStructureBundle\Document\ViewComponent;

class SuperStructureTwigExtension extends \Twig_Extension
{
    protected $container;
    /**
     * @var DocumentManager
     */
    protected $dm;
    protected $ctx;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->dm = $this->container->get('doctrine_mongodb')->getManager();
        $this->ctx = $this->container->get('superstructure.context');
    }


    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('viewComponent', array($this, 'viewComponent'))
        );
    }

    public function getGlobals()
    {
        return array(
            'container' => $this->container
        );
    }


    public function getName()
    {
        return 'super_structure_extension';
    }

    public function viewComponent($name)
    {
        try {
            /** @var $vc ViewComponent */
            $vc = $this->dm->getRepository('SuperStructureBundle:ViewComponent')->findOneBy(array('system_key' => $name));

            $cName = $vc->getController() . 'Controller';
            $cAction = $vc->getAction() . 'Action';

            /** @var $controller Controller */
            $controller = new $cName;
            $controller->setContainer($this->container);
            /** @var $res Response */
            $res = $controller->$cAction();

            return $res->getContent();
        } catch (\Exception $e) {
           return $e->getMessage();
        }
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}