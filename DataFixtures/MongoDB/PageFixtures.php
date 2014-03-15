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
use Tormit\Bundle\SuperStructureBundle\Document\Route;

class PageFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        Route::make($manager, array());
        $page = new Page();
        $page->setTitle('Avaleht');
        $page->setContent('Tere tulemast!');

        $page2 = new Page();
        $page2->setTitle('Tooted');
        $page2->setContent(
              'Tootekataloog'
        );

        $manager->persist($page);
        $manager->persist($page2);

        $manager->flush();
        Route::make($manager, array($page));
        Route::make($manager, array($page2));
        Route::make($manager, array($page, $page2));
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 0;
    }
}