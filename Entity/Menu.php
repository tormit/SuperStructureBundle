<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/16/13 9:42 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="menu")
 */
class Menu
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Structure", inversedBy="menus")
     * @ORM\JoinTable(name="menu_vs_node")
     */
    private $nodes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nodes = new ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add nodes
     *
     * @param Structure $nodes
     * @return Menu
     */
    public function addNode(Structure $nodes)
    {
        $this->nodes[] = $nodes;

        return $this;
    }

    /**
     * Remove nodes
     *
     * @param Structure $nodes
     */
    public function removeNode(Structure $nodes)
    {
        $this->nodes->removeElement($nodes);
    }

    /**
     * Get nodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNodes()
    {
        return $this->nodes;
    }
}