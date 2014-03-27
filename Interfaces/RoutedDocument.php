<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/30/13 8:54 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Interfaces;


use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Tormit\Bundle\SuperStructureBundle\Document\Route;

interface RoutedDocument
{
    public function getControllerName();

    public function getBundleName();

    public function getIdentifier();

    public function getRoutes();

    public function addRoute(Route $route);

    public function removeRoute(Route $route);

    public function listenerPostPersist(RoutedDocument $document, LifecycleEventArgs $args);

    public function listenerPostRemove(RoutedDocument $document, LifecycleEventArgs $args);
}