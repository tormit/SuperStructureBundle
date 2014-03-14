<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/14/14 6:23 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Document;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Config\Definition\Exception\Exception;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

/**
 * @MongoDB\Document
 * @package Tormit\Bundle\SuperStructureBundle\Document
 */
class Route
{
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\String @MongoDB\Index
     */
    private $route;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object1;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object2;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object3;

    /**
     * Get id
     *
     * @return MongoDB\ObjectId $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * Get route
     *
     * @return string $route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set object1
     *
     * @param $object1
     * @return self
     */
    public function setObject1($object1)
    {
        $this->object1 = $object1;
        return $this;
    }

    /**
     * Get object1
     *
     * @return $object1
     */
    public function getObject1()
    {
        return $this->object1;
    }

    /**
     * Set object2
     *
     * @param $object2
     * @return self
     */
    public function setObject2($object2)
    {
        $this->object2 = $object2;
        return $this;
    }

    /**
     * Get object2
     *
     * @return $object2
     */
    public function getObject2()
    {
        return $this->object2;
    }

    /**
     * Set object3
     *
     * @param $object3
     * @return self
     */
    public function setObject3($object3)
    {
        $this->object3 = $object3;
        return $this;
    }

    /**
     * Get object3
     *
     * @return $object3
     */
    public function getObject3()
    {
        return $this->object3;
    }


    public static function make(ObjectManager $dm, array $objects)
    {
        $route = new self();
        $routeRoutes = array();
        /** @var $obj RoutedDocument */
        foreach ($objects as $nr => $obj) {
            $routeRoutes[] = $obj->getIdentifier();
            $m = 'setObject' . ($nr + 1);
            $route->$m($obj);
        }

        $route->setRoute('/' . implode('/', $routeRoutes));
        $dm->persist($route);
    }
}
