<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/16/13 9:44 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class ObjectController extends Controller
{
    abstract public function objectAction($objectClass, $bundleName, $objectSlug);
}