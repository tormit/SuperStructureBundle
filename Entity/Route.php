<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/24/13 5:25 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="route", indexes={@ORM\Index(name="object_slug_idx", columns={"object_slug"})})
 */
class Route
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $route;
    /**
     * @ORM\Column(name="object_slug", type="string")
     */
    protected $objectSlug;
    /**
     * @ORM\Column(name="entity_class", type="string")
     */
    protected $entityClass;
    /**
     * @ORM\Column(name="bundle", type="string")
     */
    protected $bundle;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $layout;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $view;

    /**
     * @ORM\Column(name="target_route", type="string", nullable=true)
     */
    protected $targetRoute;
    /**
     * @ORM\Column(name="target_route_type", type="string", nullable=true)
     */
    protected $targetRouteType;

    /**
     * @param mixed $targetRouteType
     */
    public function setTargetRouteType($targetRouteType)
    {
        $this->targetRouteType = $targetRouteType;
    }

    /**
     * @return mixed
     */
    public function getTargetRouteType()
    {
        return $this->targetRouteType;
    }

    /**
     * @param mixed $targetRoute
     */
    public function setTargetRoute($targetRoute)
    {
        $this->targetRoute = $targetRoute;
    }

    /**
     * @return mixed
     */
    public function getTargetRoute()
    {
        return $this->targetRoute;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $objectSlug
     */
    public function setObjectSlug($objectSlug)
    {
        $this->objectSlug = $objectSlug;
    }

    /**
     * @return mixed
     */
    public function getObjectSlug()
    {
        return $this->objectSlug;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $entityClass
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @return mixed
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param mixed $bundle
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    }

    /**
     * @return mixed
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    public function isAlias()
    {
        return $this->getTargetRoute() !== null;
    }

}