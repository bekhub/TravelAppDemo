<?php


namespace MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MainBundle\Entity\Tours;

class ToursFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tour1 = new Tours();
        $tour1->setName('South America');
        $tour1->setTitle('South America - 5 Days in Lake Tahoe');
        $tour1->setTitleImage('single-sea-tours-image-bg1.jpg');
        $tour1->setAboutTitle('About South America');
        $tour1->setAboutText('Unfortunate intersection of comedy dinner and a kitchen bench Veep star Julia Louis-Dreyfus responded to BuzzFeed journalist Mark Di Stefano’s tweet about the report: I mean, c’mon, I’m actually having a hard time believing it. But the real question is what episode? Perrett later told BuzzFeed News the scene that induced the laughter that led to choking was one in the first episode.
Allowing Northern Ireland to rejoin the EU if Ireland is united This is a very big deal. It suggests at one level that Brexit really does mean Brexit in the very literal sense that the entity that is exiting is Great Britain and not the United Kingdom There has been a habit of using Britain.');
        $tour1->setDays(5);
        $tour1->setPrice(1500);
        $manager->persist($tour1);

        $tour2 = new Tours();
        $tour2->setName('Thailand');
        $tour2->setTitle('Thailand - 10 Days in Lake Tahoe');
        $tour2->setTitleImage('single-sea-tours-image-bg2.jpg');
        $tour2->setAboutTitle('About Thailand');
        $tour2->setAboutText('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, adipisci culpa cum, dolor eaque enim excepturi illo illum iste itaque iure iusto minus necessitatibus nesciunt non nostrum odio odit provident quibusdam, vel! Ab accusamus accusantium adipisci aspernatur at deserunt, eligendi est hic ipsum, natus, nemo odit quo reiciendis rem veniam!');
        $tour2->setDays(10);
        $tour2->setPrice(2500);
        $manager->persist($tour2);

        $tour3 = new Tours();
        $tour3->setName('Mozambique');
        $tour3->setTitle('Mozambique - 7 Days in Lake Tahoe');
        $tour3->setTitleImage('single-sea-tours-image-bg3.jpg');
        $tour3->setAboutTitle('About Mozambique');
        $tour3->setAboutText('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, adipisci culpa cum, dolor eaque enim excepturi illo illum iste itaque iure iusto minus necessitatibus nesciunt non nostrum odio odit provident quibusdam, vel! Ab accusamus accusantium adipisci aspernatur at deserunt, eligendi est hic ipsum, natus, nemo odit quo reiciendis rem veniam!');
        $tour3->setDays(7);
        $tour3->setPrice(5500);
        $manager->persist($tour3);

        $manager->flush();

        $this->addReference('tour-1', $tour1);
        $this->addReference('tour-2', $tour2);
        $this->addReference('tour-3', $tour3);
    }

    public function getOrder()
    {
        return 1;
    }
}