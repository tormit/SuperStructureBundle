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
    protected $identifierMethod = 'getSlug';

    public function getIdentifier()
    {
        if (method_exists($this, $this->identifierMethod)) {
            return $this->{$this->identifierMethod}();
        }

        throw new \BadMethodCallException(sprintf('Identifier method "%s" not implemented on routed document "%s"', $this->identifierMethod, get_class($this)));
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