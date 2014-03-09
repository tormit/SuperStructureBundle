<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/29/13 4:59 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\Interfaces;


interface EntityControllerInterface
{
    public function getControllerName();

    public function getBundleName();

    public function getSlug();
}