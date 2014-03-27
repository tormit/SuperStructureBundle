<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/14/14 2:16 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

/**
 * @MongoDB\Document
 * @package Tormit\Bundle\SuperStructureBundle\Document
 */
class Page extends AbstractRoutedDocument implements RoutedDocument
{
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\String
     */
    private $title;

    /**
     * @MongoDB\String
     */
    private $content;

    /**
     * @MongoDB\String
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Route")
     * @var ArrayCollection
     */
    private $routes;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
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
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getControllerName()
    {
        return 'Page';
    }

    public function getBundleName()
    {
        return 'SuperStructureBundle';
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Add route
     *
     * @param Route $route
     */
    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * Remove route
     *
     * @param Route $route
     */
    public function removeRoute(Route $route)
    {
        $this->routes->removeElement($route);
    }
}
