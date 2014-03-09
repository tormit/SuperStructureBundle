<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 4:43 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\EventListener;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Tormit\SuperStructureBundle\Entity\Route;
use Tormit\SuperStructureBundle\Entity\Structure;
use Tormit\SymfonyHelpersBundle\LogUtil;

class SuperstructureEvents
{
    private static $pathCached = array();

    public function postPersist(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Structure) {
            $this->postSaveStructure($args->getEntity(), $args->getEntityManager());
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Structure) {
            $this->postSaveStructure($args->getEntity(), $args->getEntityManager());
        }
    }

    public function postRemove(LifecycleEventArgs $args)
    {

    }

    private function postSaveStructure(Structure $node, EntityManager $em)
    {
        /** @var $structureRepo NestedTreeRepository */
        $structureRepo = $em->getRepository('SuperStructureBundle:Structure');
        $entityPath = $structureRepo->getPath($node);

        $pathParts = array();

        /** @var $part Structure */
        foreach ($entityPath as $part) {
            if ($part->getLevel() > 0) {
                $pathParts[] = $part->getSlug();
            }
        }

        $nodePathAsRoute = '/' . implode('/', $pathParts);

        $routeRepo = $em->getRepository('SuperStructureBundle:Route');
        //$route = $routeRepo->findOneBy(array('objectSlug' => $node->getSlug(), 'entityClass' => get_class($node)));
        $route = $routeRepo->findOneBy(array('route' => $nodePathAsRoute));

        if (!isset(self::$pathCached[$node->getId()])) {
            $node->setSlugPath($pathParts);

            $em->persist($node);
            self::$pathCached[$node->getId()] = true;
        }

        $classNameParts = explode('\\', get_class($node));
        $className = $classNameParts[count($classNameParts) - 1]; // last item
        $bundleName = null;

        foreach ($classNameParts as $clPart) {
            if (strpos($clPart, 'Bundle') !== false) {
                $bundleName = $clPart;
                break;
            }
        }
        if (!$bundleName) {
            throw new \Exception('Cannot find bundle name!');
        }


        if (!($route instanceof Route)) {
            $route = new Route();
            $route->setRoute($nodePathAsRoute);
            $route->setEntityClass($className);
            $route->setBundle($bundleName);
            $route->setObjectSlug($node->getSlug());
            if ($node->getRouteTargetEntity() != null) {
                $route->setTargetRoute($node->getRouteTargetEntity()->getSlugPath());
            }

        } else {
            $route->setRoute($nodePathAsRoute);
        }
        $em->persist($route);
        $em->flush();
    }
}