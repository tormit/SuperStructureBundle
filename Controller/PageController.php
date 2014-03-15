<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 5:02 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Controller;


use Tormit\Bundle\SuperStructureBundle\Document\Route;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

class PageController extends ObjectController
{
    public function objectAction(RoutedDocument $document, Route $route)
    {
        $layout = $route->getLayout();
        if (empty($layout)) {
            $layout = 'SuperStructureBundle::layout.html.twig';
        }

        return $this->render('SuperStructureBundle:Page:page.html.twig', array('node' => $document, 'layout' => $layout));
    }
}
