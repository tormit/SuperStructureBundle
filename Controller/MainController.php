<?php

namespace Tormit\Bundle\SuperStructureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tormit\Bundle\SuperStructureBundle\Entity\Route;
use Tormit\Bundle\SuperStructureBundle\Interfaces\EntityControllerInterface;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedEntity;
use Tormit\SymfonyHelpersBundle\LogUtil;

class MainController extends Controller
{
    const API_JSON = 'json';
    const API_XML = 'xml';
    const API_RSS = 'rss';

    protected $route;
    protected $request;
    protected $em;

    protected function init()
    {
        $this->request = $this->getRequest();
        $this->em = $this->getDoctrine()->getManager();
    }

    public function viewAction()
    {
        $this->init();

        $route = $this->findRoute();
        $routeedObject = $this->findRouteObject($route);

        // respond view
        if ($routeedObject instanceof RoutedEntity) {
            return $this->forward(
                        sprintf('%s:%s:object', $routeedObject->getBundleName(), $routeedObject->getControllerName()),
                        array('objectClass' => $route->getEntityClass(), 'bundleName' => $route->getBundle(), 'objectSlug' => $route->getObjectSlug(), 'route' => $route)
            );
        } else {

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

    /**
     * @return Route
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function findRoute()
    {
        $this->route = '/' . $this->request->get('p1');
        if ($this->request->get('p2') !== false) {
            $this->route .= '/' . $this->request->get('p2');
        }
        if ($this->request->get('p3') !== false) {
            $this->route .= '/' . $this->request->get('p3');
        }
        if ($this->request->get('p4') !== false) {
            $this->route .= '/' . $this->request->get('p4');
        }
        if ($this->request->get('p5') !== false) {
            $this->route .= '/' . $this->request->get('p5');
        }


        $routeRepository = $this->em->getRepository('SuperStructureBundle:Route');

        $route = $routeRepository->findOneBy(array('route' => $this->route));

        // identify object
        if (!($route instanceof Route)) {
            throw new NotFoundHttpException('Route not found');
        }
        return $route;
    }

    /**
     * @param $route
     * @return RoutedEntity
     */
    protected function findRouteObject(Route $route)
    {
        $objRepo = $this->em->getRepository(sprintf('%s:%s', $route->getBundle(), $route->getEntityClass()));
        /** @var $routeObject EntityControllerInterface */
        $routeObject = $objRepo->findOneBy(array('slug' => $route->getObjectSlug()));
        return $routeObject;
    }
}
