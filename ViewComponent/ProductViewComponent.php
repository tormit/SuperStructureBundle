<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/29/14 12:18 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\ViewComponent;


class ProductViewComponent extends ViewComponent
{
    public function markFavoriteAction()
    {
        return $this->render('SuperStructureBundle:Product:fav.html.twig');
    }
} 