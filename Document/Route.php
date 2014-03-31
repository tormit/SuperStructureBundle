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
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

/**
 * @MongoDB\Document
 * @package Tormit\Bundle\SuperStructureBundle\Document
 */
class Route
{
    const ROUTE_SEGMENTS_COUNT = 10;

    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\String @MongoDB\UniqueIndex(order="asc")
     */
    private $route;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Route")
     */
    private $new_route;

    /**
     * @MongoDB\ReferenceOne
     */
    private $leaf;

    /**
     * @MongoDB\String
     */
    private $layout;

    /**
     * @MongoDB\String
     */
    private $view;

    /**
     * @MongoDB\Boolean
     */
    private $is_active = true;

    /**
     * @MongoDB\Boolean
     */
    private $is_valid = true;

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
     * @MongoDB\ReferenceOne
     */
    private $object4;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object5;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object6;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object7;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object8;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object9;

    /**
     * @MongoDB\ReferenceOne
     */
    private $object10;

    public static function make(ObjectManager $dm, array $objects)
    {
        $routeRoutes = array();
        /** @var $obj RoutedDocument */
        foreach ($objects as $obj) {
            $routeRoutes[] = $obj->getIdentifier();
        }
        $routePathString = '/' . implode('/', $routeRoutes);

        $routeObj = $dm->getRepository('SuperStructureBundle:Route')->findOneBy(array('route' => $routePathString));
        if (!($routeObj instanceof Route)) {
            $routeObj = new self();
            $routeObj->setRoute($routePathString);
        }

        $routeObj->setObjectChain($objects);

        $dm->persist($routeObj);
        $dm->flush();
    }

    public function setObjectChain(array $objects = array())
    {
        $leafKey = null;
        for ($i = 1; $i <= self::ROUTE_SEGMENTS_COUNT; $i++) {
            $i0 = $i - 1;
            $m = 'setObject' . $i;
            if (isset($objects[$i0])) {
                if (!($objects[$i0] instanceof RoutedDocument)) {
                    throw new \Exception('Value nr ' . $i . ' not RoutedDocument.');
                }
                $leafKey = $i0;
                $this->$m($objects[$i0]);
            } else {
                $this->$m(null);
            }
        }
        if ($leafKey !== null) {
            $this->setLeaf($objects[$leafKey]);
        }
    }

    public static function makeRoot(ObjectManager $dm, RoutedDocument $object)
    {
        $routePathString = '/';

        $routeObj = $dm->getRepository('SuperStructureBundle:Route')->findOneBy(array('route' => $routePathString));
        if (!($routeObj instanceof Route)) {
            $routeObj = new self();
            $routeObj->setRoute($routePathString);
        }

        $routeObj->setObjectChain(array($object));

        $dm->persist($routeObj);
        $dm->flush();
    }

    public function getSlugPathForRouter()
    {
        $ar = array();
        $i = 1;
        foreach ($this->getSlugPath() as $slug) {
            $ar['p' . $i] = $slug;
            $i++;
        }

        return $ar;
    }

    public function getSlugPath($glue = null)
    {
        $path = array();
        for ($i = 1; $i <= self::ROUTE_SEGMENTS_COUNT; $i++) {
            $i0 = $i - 1;
            $m = 'getObject' . $i;

            $o = $this->$m();
            if ($o instanceof RoutedDocument) {
                $path[] = $o->getIdentifier();
            }
        }

        return is_string($glue) ? implode($glue, $path) : $path;
    }

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
     * Get route
     *
     * @return string $route
     */
    public function getRoute()
    {
        return $this->route;
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
     * Get leaf
     *
     * @return $leaf
     */
    public function getLeaf()
    {
        return $this->leaf;
    }

    /**
     * Set leaf
     *
     * @param $leaf
     * @return self
     */
    public function setLeaf(RoutedDocument $leaf)
    {
        $this->leaf = $leaf;
        return $this;
    }

    /**
     * Get layout
     *
     * @return string $layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set layout
     *
     * @param string $layout
     * @return self
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Get view
     *
     * @return string $view
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set view
     *
     * @param string $view
     * @return self
     */
    public function setView($view)
    {
        $this->view = $view;
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
     * Set object1
     *
     * @param $object1
     * @return self
     */
    public function setObject1(RoutedDocument $object1 = null)
    {
        $this->object1 = $object1;
        if ($object1 !== null) {
            $object1->addRoute($this);
        }
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
     * Set object2
     *
     * @param $object2
     * @return self
     */
    public function setObject2(RoutedDocument $object2 = null)
    {
        $this->object2 = $object2;
        if ($object2 !== null) {
            $object2->addRoute($this);
        }
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

    /**
     * Set object3
     *
     * @param $object3
     * @return self
     */
    public function setObject3(RoutedDocument $object3 = null)
    {
        $this->object3 = $object3;
        if ($object3 !== null) {
            $object3->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object4
     *
     * @return $object4
     */
    public function getObject4()
    {
        return $this->object4;
    }

    /**
     * Set object4
     *
     * @param $object4
     * @return self
     */
    public function setObject4(RoutedDocument $object4 = null)
    {
        $this->object4 = $object4;
        if ($object4 !== null) {
            $object4->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object5
     *
     * @return $object5
     */
    public function getObject5()
    {
        return $this->object5;
    }

    /**
     * Set object5
     *
     * @param $object5
     * @return self
     */
    public function setObject5(RoutedDocument $object5 = null)
    {
        $this->object5 = $object5;
        if ($object5 !== null) {
            $object5->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object6
     *
     * @return $object6
     */
    public function getObject6()
    {
        return $this->object6;
    }

    /**
     * Set object6
     *
     * @param $object6
     * @return self
     */
    public function setObject6(RoutedDocument $object6 = null)
    {
        $this->object6 = $object6;
        if ($object6 !== null) {
            $object6->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object7
     *
     * @return $object7
     */
    public function getObject7()
    {
        return $this->object7;
    }

    /**
     * Set object7
     *
     * @param $object7
     * @return self
     */
    public function setObject7(RoutedDocument $object7 = null)
    {
        $this->object7 = $object7;
        if ($object7 !== null) {
            $object7->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object8
     *
     * @return $object8
     */
    public function getObject8()
    {
        return $this->object8;
    }

    /**
     * Set object8
     *
     * @param $object8
     * @return self
     */
    public function setObject8(RoutedDocument $object8 = null)
    {
        $this->object8 = $object8;
        if ($object8 !== null) {
            $object8->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object9
     *
     * @return $object9
     */
    public function getObject9()
    {
        return $this->object9;
    }

    /**
     * Set object9
     *
     * @param $object9
     * @return self
     */
    public function setObject9(RoutedDocument $object9 = null)
    {
        $this->object9 = $object9;
        if ($object9 !== null) {
            $object9->addRoute($this);
        }
        return $this;
    }

    /**
     * Get object10
     *
     * @return $object10
     */
    public function getObject10()
    {
        return $this->object10;
    }

    /**
     * Set object10
     *
     * @param $object10
     * @return self
     */
    public function setObject10(RoutedDocument $object10 = null)
    {
        $this->object10 = $object10;
        if ($object10 !== null) {
            $object10->addRoute($this);
        }
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean $isActive
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean $isValid
     */
    public function getIsValid()
    {
        return $this->is_valid;
    }

    /**
     * Set isValid
     *
     * @param boolean $isValid
     * @return self
     */
    public function setIsValid($isValid)
    {
        $this->is_valid = $isValid;
        return $this;
    }

    /**
     * Get newRoute
     *
     * @return Route $newRoute
     */
    public function getNewRoute()
    {
        return $this->new_route;
    }

    /**
     * Set newRoute
     *
     * @param Route $newRoute
     * @return self
     */
    public function setNewRoute(Route $newRoute)
    {
        $this->new_route = $newRoute;
        return $this;
    }
}
