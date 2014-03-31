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
        $page = new Page();
        $page->setTitle('Avaleht');
        $page->setContent('Tere tulemast!');
        $manager->persist($page);

        $page2 = new Page();
        $page2->setTitle('Tooted');
        $page2->setContent(
              'Tootekataloog'
        );
        $manager->persist($page2);

        $pageAbout = new Page();
        $pageAbout->setTitle('Meist');
        $pageAbout->setContent('Meist');
        $manager->persist($pageAbout);

        $pageContact = new Page();
        $pageContact->setTitle('Kontakt');
        $pageContact->setContent('Kontakt');
        $manager->persist($pageContact);


        $manager->flush();
        Route::makeRoot($manager, $page);
        Route::make($manager, array($page));
        Route::make($manager, array($page2));
        Route::make($manager, array($page, $page2));
        Route::make($manager, array($pageAbout, $pageContact));
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