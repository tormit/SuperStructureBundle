<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2014
 * @since 03/10/14 21:25 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tormit\Bundle\SuperStructureBundle\Document\Page;
use Tormit\Bundle\SuperStructureBundle\Document\Product;
use Tormit\Bundle\SuperStructureBundle\Document\Route;
use Tormit\Bundle\SuperStructureBundle\Document\ViewComponent;

class RouteFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        // make some routes manually

        $targetRoute1 = $manager->getRepository('SuperStructureBundle:Route')
                                ->findOneBy(array('route' => '/meist/kontakt'));
        $route1 = new Route();
        $route1->setRoute('/meist');
        $route1->setNewRoute($targetRoute1);

        $manager->persist($route1);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2000;
    }
}