<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/16/13 9:42 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="frontend_menu")
 */
class FrontendMenu
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
     * @ORM\JoinTable(name="frontend_menu_vs_node")
     */
    private $nodes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return PersistentCollection
     */
    public function getItems()
    {
        return $this->nodes;
    }

    function __toString()
    {
        return $this->getTitle();
    }

}