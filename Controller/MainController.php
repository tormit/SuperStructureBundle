<?php

namespace Tormit\Bundle\SuperStructureBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tormit\Bundle\SuperStructureBundle\Context\SuperStructureContext;
use Tormit\Bundle\SuperStructureBundle\Document\Route;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;
use Tormit\SymfonyHelpersBundle\Util\Util;

class MainController extends Controller
{
    const API_JSON = 'json';
    const API_XML = 'xml';
    const API_RSS = 'rss';

    protected $requestedRoute;
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

        if ($this->requestedRoute !== $route->getRoute()) {
            return $this->redirect($this->generateUrl('super_structure_main', $route->getSlugPathForRouter()));
        }


        // respond view
        if ($routedDocument instanceof RoutedDocument) {
            /** @var $ctx SuperStructureContext */
            $ctx = $this->get('superstructure.context');
            $ctx->setRoute($route);

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
        $this->requestedRoute = '/';
        $routeParts = array();
        for ($i = 1; $i <= Route::ROUTE_SEGMENTS_COUNT; $i++) {
            $partValue = $this->request->get('p' . $i);
            if (!empty($partValue)) {
                $routeParts[] = $partValue;
            }
        }
        $this->requestedRoute .= implode('/', $routeParts);

        $exts = array('js' => 'js', 'css' => 'css');
        if (isset($exts[Util::findExt($this->requestedRoute)])) {
            throw new NotFoundHttpException('Resource not found');
        }

        $route = $this->em->getRepository('SuperStructureBundle:Route')->findOneBy(array('route' => $this->requestedRoute));

        // identify object
        if (!($route instanceof Route)) {
            $route = $this->em->getRepository('SuperStructureBundle:Route')->findOneBy(array('route' => '/'));
            if (!($route instanceof Route)) {
                throw new NotFoundHttpException('Route not found');
            }

            /** @var $logger LoggerInterface */
            $logger = $this->get('logger');
            $logger->error(sprintf('Route %s not exists. Switched to root(/) route.', $this->requestedRoute));
        }

        if (!$route->getIsValid() || !$route->getIsActive() || $route->getLeaf() === null) {
            $route = $route->getNewRoute();
            if (!($route instanceof Route)) {
                throw new NotFoundHttpException('Requested route is invalid. New route not set.');
            }
        }

        return $route;
    }
}
