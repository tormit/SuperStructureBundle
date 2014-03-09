<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 8/16/13 10:05 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tormit\SuperStructureBundle\Entity\Menu;

class MenuFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $mainMenu = new Menu();
        $mainMenu->setName('main');
        $mainMenu->setTitle('Main menu');

        $language = new Menu();
        $language->setName('language');
        $language->setTitle('Language menu');

        $manager->persist($mainMenu);
        $manager->persist($language);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}