<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/14/14 5:17 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Document;


use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

class AbstractRoutedDocument
{
    protected $identifiedMethod = 'getSlug';

    public function getIdentifier()
    {
        return $this->{$this->identifiedMethod}();
    }

    public function listenerPostPersist(RoutedDocument $document, LifecycleEventArgs $args)
    {
//        $route = new Route();
//        $route->setRoute('/' . $document->getIdentifier());
//        $route->setObject1($document);
//        $dm = $args->getDocumentManager();
//
//        $dm->persist($route);
//        $dm->flush();
    }

} 