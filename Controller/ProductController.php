<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 5:02 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Controller;


use Tormit\Bundle\SuperStructureBundle\Document\Route;
use Tormit\Bundle\SuperStructureBundle\Interfaces\RoutedDocument;

class ProductController extends ObjectController
{
    public function objectAction(RoutedDocument $document, Route $route)
    {
        $layout = $route->getLayout();
        if (empty($layout)) {
            $layout = 'SuperStructureBundle::layout.html.twig';
        }

        return $this->render('SuperStructureBundle:Product:product.html.twig', array('product' => $document, 'layout' => $layout));
    }

    public function vcMarkFavoriteAction()
    {
        return $this->render('SuperStructureBundle:Product:fav.html.twig');
    }
}
