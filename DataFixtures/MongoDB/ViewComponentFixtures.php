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

class ViewComponentFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $productsPage = $manager->getRepository('SuperStructureBundle:Page')->findOneBy(array('title' => 'Tooted'));
        if (!($productsPage instanceof Page)) {
            return;
        }

        $viewComponent = new ViewComponent();
        $viewComponent->setName('Mark favorite');
        $viewComponent->setSystemKey('product-mark-favorite');
        $viewComponent->setController('Tormit\Bundle\SuperStructureBundle\Controller\Product');
        $viewComponent->setBundle('SuperStructureBundle');
        $viewComponent->setAction('vcMarkFavorite');
        $viewComponent->setRequiredParameters(array('product-id'));

        $manager->persist($viewComponent);

        $manager->flush();
        Route::make($manager, array($productsPage, $viewComponent));
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1000;
    }
}