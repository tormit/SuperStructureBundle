<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/30/13 8:54 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Interfaces;


use Tormit\SuperStructureBundle\Entity\Route;

interface RoutedEntity
{
    public function setRouteTargetEntity(RoutedEntity $entity);

    public function getRouteTargetEntity();

    public function getRoutePath();

}