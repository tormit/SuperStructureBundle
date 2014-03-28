<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/28/14 4:51 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Context;


use Symfony\Component\DependencyInjection\ContainerInterface;

class SuperStructureContext
{
    protected $container;
    protected $currentController;
    protected $route;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getCurrentController()
    {
        return $this->currentController;
    }

    /**
     * @param mixed $currentController
     */
    public function setCurrentController($currentController)
    {
        $this->currentController = $currentController;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $currentRoute
     */
    public function setRoute($currentRoute)
    {
        $this->route = $currentRoute;
    }


} 