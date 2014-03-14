<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/30/13 8:54 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Interfaces;


interface RoutedEntity
{
    public function setRouteTargetEntity(RoutedEntity $entity);

    public function getRouteTargetEntity();

    public function getRoutePath();

    public function getControllerName();

    public function getBundleName();

    public function getSlug();

    public function getSlugPath();

    public function setSlugPath(array $slugPath);

}