<?php


namespace MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MainBundle\Entity\TourReviews;
use MainBundle\Entity\Tours;

class TourReviewsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $review = new TourReviews();
        $review->setUser('Mashok khan');
        $review->setEmail('example@email.com');
        $review->setReview('Significant slowdown in the rate of air quality improvement as a result of the ramping up of industrial activity around Beijing Li claimed Last December tens . ');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('symfony');
        $review->setEmail('example@email.com');
        $review->setReview('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('David');
        $review->setEmail('example@email.com');
        $review->setReview('To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Dade');
        $review->setEmail('example@email.com');
        $review->setReview('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Kate');
        $review->setEmail('example@email.com');
        $review->setReview('Are you challenging me? ');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 06:15:20"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Dade');
        $review->setEmail('example@email.com');
        $review->setReview('Name your stakes.');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 06:18:35"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Kate');
        $review->setEmail('example@email.com');
        $review->setReview('If I win, you become my slave.');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 06:22:53"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Dade');
        $review->setEmail('example@email.com');
        $review->setReview('Your SLAVE?');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 06:25:15"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Kate');
        $review->setEmail('example@email.com');
        $review->setReview('You wish! You\'ll do shitwork, scan, crack copyrights...');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 06:46:08"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Dade');
        $review->setEmail('example@email.com');
        $review->setReview('And if I win?');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 10:22:46"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Kate');
        $review->setEmail('example@email.com');
        $review->setReview('Make it my first-born!');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-23 11:08:08"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Dade');
        $review->setEmail('example@email.com');
        $review->setReview('Make it our first-date!');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $review->setCreatedAt(new \DateTime("2011-07-24 18:56:01"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Kate');
        $review->setEmail('example@email.com');
        $review->setReview('I don\'t DO dates. But I don\'t lose either, so you\'re on!');
        $review->setTourId($manager->merge($this->getReference('tour-2')));
        $review->setCreatedAt(new \DateTime("2011-07-25 22:28:42"));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Stanley');
        $review->setEmail('example@email.com');
        $review->setReview('It\'s not gonna end like this.');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Gabriel');
        $review->setEmail('example@email.com');
        $review->setReview('Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.');
        $review->setTourId($manager->merge($this->getReference('tour-3')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Mile');
        $review->setEmail('example@email.com');
        $review->setReview('Doesn\'t Bill Gates have something like that?');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $review = new TourReviews();
        $review->setUser('Gary');
        $review->setEmail('example@email.com');
        $review->setReview('Bill Who?');
        $review->setTourId($manager->merge($this->getReference('tour-1')));
        $manager->persist($review);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}