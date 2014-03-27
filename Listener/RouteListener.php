<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/14/14 5:00 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Listener;


use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

class RouteListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof RoutedDocument) {
            $document->listenerPostPersist($document, $args);
        }
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof RoutedDocument) {
            $document->listenerPostRemove($document, $args);
        }
    }
} 