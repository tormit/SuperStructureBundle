<?php

namespace Tormit\SuperStructureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tormit\SuperStructureBundle\Entity\Route;
use Tormit\SuperStructureBundle\Interfaces\EntityControllerInterface;
use Tormit\SymfonyHelpersBundle\LogUtil;

class MainController extends Controller
{
    const API_JSON = 'json';
    const API_XML = 'xml';
    const API_RSS = 'rss';

    protected $route;

    // this will come from database
    private $routeRepo = array(
        '/' => '',
        '/est' => '',
        '/est/list' => '',
        '/est/list/item' => '',
    );

    public function viewAction()
    {
        $this->route = '/' . $this->getRequest()->get('p1');
        if ($this->getRequest()->get('p2') !== false) {
            $this->route .= '/' . $this->getRequest()->get('p2');
        }
        if ($this->getRequest()->get('p3') !== false) {
            $this->route .= '/' . $this->getRequest()->get('p3');
        }
        if ($this->getRequest()->get('p4') !== false) {
            $this->route .= '/' . $this->getRequest()->get('p4');
        }
        if ($this->getRequest()->get('p5') !== false) {
            $this->route .= '/' . $this->getRequest()->get('p5');
        }
        LogUtil::debug($this->route);

        $em = $this->getDoctrine()->getManager();
        $rRepo = $em->getRepository('SuperStructureBundle:Route');

        $route = $rRepo->findOneBy(array('route' => $this->route));

        // identify object
        if (!($route instanceof Route)) {
            throw new NotFoundHttpException('Route not found');
        }

        // find object
        $objRepo = $em->getRepository(sprintf('%s:%s', $route->getBundle(), $route->getEntityClass()));
        /** @var $routeObj EntityControllerInterface */
        $routeObj = $objRepo->findOneBy(array('slug' => $route->getObjectSlug()));

        // respond view
        if ($routeObj) {
            return $this->forward(
                sprintf('%s:%s:object', $routeObj->getBundleName(), $routeObj->getControllerName()),
                array('objectClass' => $route->getEntityClass(), 'bundleName' => $route->getBundle(), 'objectSlug' => $route->getObjectSlug())
            );
        }

        if (!isset($this->routeRepo[$this->route])) {
            throw new NotFoundHttpException('Dont know how to handle this page.');
        }

        $action = $this->routeRepo[$this->route];
        if (empty($action)) {
            return $this->render('SuperStructureBundle:Main:index.html.twig', array('route' => $this->route));
        } else {
            return $this->$action();
        }
    }

    public function apiAction()
    {
        $res = null;
        switch ($this->getRequest()->get('type')) {
            case self::API_JSON:
                $res = new JsonResponse();
                break;
            default:
                throw new BadRequestHttpException('Cannot handle this type');
        }

        return $res;
    }
}
