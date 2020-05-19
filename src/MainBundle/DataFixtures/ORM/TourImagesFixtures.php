<?php


namespace MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MainBundle\Entity\TourImages;
use MainBundle\Entity\Tours;

class TourImagesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $review = new TourImages();
        $review->setImage('tours-details-gallery-single1.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single2.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single3.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single1.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single2.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single3.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single1.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single2.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $manager->persist($review);

        $review = new TourImages();
        $review->setImage('tours-details-gallery-single3.jpg');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $manager->persist($review);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}