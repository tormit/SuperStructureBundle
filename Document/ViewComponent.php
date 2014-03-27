<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/27/14 11:57 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Document;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

/**
 * @MongoDB\Document
 * @package Tormit\Bundle\SuperStructureBundle\Document
 */
class ViewComponent extends AbstractRoutedDocument implements RoutedDocument
{
    protected $identifierMethod = 'getSystemKey';
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\String
     */
    private $name;

    /**
     * @MongoDB\String
     */
    private $system_key;

    /**
     * @MongoDB\String
     */
    private $controller;

    /**
     * @MongoDB\String
     */
    private $bundle;

    /**
     * @MongoDB\String
     */
    private $action;

    /**
     * @MongoDB\Collection
     */
    private $required_parameters;


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
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get controller
     *
     * @return string $controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return self
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * Get bundle
     *
     * @return string $bundle
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * Set bundle
     *
     * @param string $bundle
     * @return self
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
        return $this;
    }

    /**
     * Get action
     *
     * @return string $action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get systemKey
     *
     * @return string $systemKey
     */
    public function getSystemKey()
    {
        return $this->system_key;
    }

    /**
     * Set systemKey
     *
     * @param string $systemKey
     * @return self
     */
    public function setSystemKey($systemKey)
    {
        $this->system_key = $systemKey;
        return $this;
    }

    public function getControllerName()
    {
        // TODO: Implement getControllerName() method.
    }

    public function getBundleName()
    {
        // TODO: Implement getBundleName() method.
    }

    public function getRoutes()
    {
        // TODO: Implement getRoutes() method.
    }

    public function addRoute(Route $route)
    {
        // TODO: Implement addRoute() method.
    }

    public function removeRoute(Route $route)
    {
        // TODO: Implement removeRoute() method.
    }

    /**
     * Set requiredParameters
     *
     * @param array $requiredParameters
     * @return self
     */
    public function setRequiredParameters(array $requiredParameters = array())
    {
        $this->required_parameters = $requiredParameters;
        return $this;
    }

    /**
     * Get requiredParameters
     *
     * @return array $requiredParameters
     */
    public function getRequiredParameters()
    {
        return $this->required_parameters;
    }
}
