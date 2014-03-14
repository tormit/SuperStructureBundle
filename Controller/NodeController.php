<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 5:02 PM
 * @version 1.0
 */

namespace Tormit\Bundle\SuperStructureBundle\Controller;


use Tormit\Bundle\SuperStructureBundle\Entity\Route;

class NodeController extends ObjectController
{
    public function objectAction($objectClass, $bundleName, $objectSlug, Route $route)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(sprintf('%s:%s', $bundleName, $objectClass));
        $obj = $repo->findOneBy(array('slug' => $objectSlug));

        $layout = $route->getLayout();
        if (empty($layout)) {
            $layout = 'SuperStructureBundle::layout.html.twig';
        }

        return $this->render('SuperStructureBundle:Node:node.html.twig', array('node' => $obj, 'layout' => $layout));
    }
}
