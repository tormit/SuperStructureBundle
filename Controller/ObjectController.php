<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/16/13 9:44 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tormit\Bundle\SuperStructureBundle\Entity\Route;

abstract class ObjectController extends Controller
{
    abstract public function objectAction($objectClass, $bundleName, $objectSlug, Route $route);
}