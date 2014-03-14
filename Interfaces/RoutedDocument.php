<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/30/13 8:54 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Interfaces;


use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

interface RoutedDocument
{
    public function getControllerName();

    public function getBundleName();

    public function getIdentifier();

    public function listenerPostPersist(RoutedDocument $document, LifecycleEventArgs $args);
}