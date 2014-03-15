<?php

namespace Tormit\Bundle\SuperStructureBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tormit\Bundle\SuperStructureBundle\Document\Route;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

class MainController extends Controller
{
    const API_JSON = 'json';
    const API_XML = 'xml';
    const API_RSS = 'rss';

    protected $route;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var DocumentManager
     */
    protected $em;

    protected function init(Request $request)
    {
        $this->request = $request;
        $this->em = $this->get('doctrine_mongodb')->getManager();
    }

    public function viewAction(Request $request)
    {
        $this->init($request);

        $route = $this->findRoute();
        $routedDocument = $route->getLeaf();

        // respond view
        if ($routedDocument instanceof RoutedDocument) {
            return $this->forward(
                        sprintf('%s:%s:object', $routedDocument->getBundleName(), $routedDocument->getControllerName()),
                        array('document' => $routedDocument, 'route' => $route)
            );
        } else {

        }
    }

    /**
     * @return Route
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function findRoute()
    {
        $this->route = '/';
        $routeParts = array();
        for ($i = 1; $i <= Route::ROUTE_SEGMENTS_COUNT; $i++) {
            $partValue = $this->request->get('p' . $i);
            if (!empty($partValue)) {
                $routeParts[] = $partValue;
            }
        }
        $this->route .= implode('/', $routeParts);

        $route = $this->em->getRepository('SuperStructureBundle:Route')->findOneBy(array('route' => $this->route));

        // identify object
        if (!($route instanceof Route)) {
            throw new NotFoundHttpException('Route not found');
        }
        return $route;
    }
}
