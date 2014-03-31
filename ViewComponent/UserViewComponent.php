<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 3/29/14 12:18 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\ViewComponent;


class UserViewComponent extends ViewComponent
{
    /**
     *
     * @SuperStructure\ViewComponent(name="user-box")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userBoxAction()
    {
        return $this->render('SuperStructureBundle:User:userBox.html.twig');
    }
} 