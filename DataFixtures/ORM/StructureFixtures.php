<?php
/**
 * @author Tormi Talv <tormit@gmail.com> 2013
 * @since 7/25/13 2:55 PM
 * @version 1.0
 */

namespace Tormit\SuperStructureBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tormit\SuperStructureBundle\Entity\Menu;
use Tormit\SuperStructureBundle\Entity\Structure;

class StructureFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    function load(ObjectManager $manager)
    {
        $menuRepo = $manager->getRepository('SuperStructureBundle:Menu');
        /** @var $mainMenu Menu */
        $mainMenu = $menuRepo->findOneBy(array('name' => 'main'));

        /** @var $languageMenu Menu */
        $languageMenu = $menuRepo->findOneBy(array('name' => 'language'));

        $root = new Structure();
        $root->setTitle('root');

        {

            $est = new Structure();
            $est->setTitle('Estonian');
            $est->setParent($root);
            $est->setSlug('est');
            $languageMenu->addNode($est);


            {
                $kontakt = new Structure();
                $kontakt->setTitle('Kontakt');
                $kontakt->setContent('<h1>Võta meiega ühendust 555-6768</h1>');
                $kontakt->setParent($est);
                $mainMenu->addNode($kontakt);
            }
        }

        {
            $eng = new Structure();
            $eng->setTitle('English');
            $eng->setParent($root);
            $eng->setSlug('eng');
            $languageMenu->addNode($eng);

            {
                $contact = new Structure();
                $contact->setTitle('Contact');
                $contact->setContent('<h1>Contact us 555-6768</h1>');
                $contact->setParent($eng);
                $mainMenu->addNode($contact);
            }
        }

        $manager->persist($root);
        $manager->persist($est);
        $manager->persist($eng);
        $manager->persist($kontakt);
        $manager->persist($contact);
        $manager->flush();

        // set target for lang
        $est->setRouteTargetEntity($kontakt);
        $manager->persist($est);
        $manager->flush();
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
