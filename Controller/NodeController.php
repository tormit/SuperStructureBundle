<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 5:02 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Controller;


class NodeController extends ObjectController
{
    public function objectAction($objectClass, $bundleName, $objectSlug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(sprintf('%s:%s', $bundleName, $objectClass));
        $obj = $repo->findOneBy(array('slug' => $objectSlug));

        return $this->render('SuperStructureBundle:Node:node.html.twig', array('node' => $obj));
    }
}
