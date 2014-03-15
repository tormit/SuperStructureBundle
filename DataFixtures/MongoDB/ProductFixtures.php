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

class ProductFixtures extends AbstractFixture implements OrderedFixtureInterface
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

        $product = new Product();
        $product->setName('Nexus 5');
        $product->setDescription(
                'Nexus phone releases are timed to let Google have the last word - and what a way to have it! A phone that matches any flagship on specs and premieres the latest OS version, but costs barely half as much as some of them. The Nexus 5 promises a great finale to yet another exciting smartphone season and it\'s not only the droids that stand to attention.'
        );

        $product2 = new Product();
        $product2->setName('Lenovo X220');
        $product2->setDescription(
                 'The 12.5" ThinkPad X240 Ultrabook™ is thin, light, built to last, and ready for business. Power Bridge technology lets you go ten or more hours without plugging in, vPro gives you the ultimate in manageability, and plenty of other features let you take your business on the road.'
        );

        $manager->persist($product);
        $manager->persist($product2);

        $manager->flush();
        Route::make($manager, array($productsPage, $product));
        Route::make($manager, array($productsPage, $product2));
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 100;
    }
}