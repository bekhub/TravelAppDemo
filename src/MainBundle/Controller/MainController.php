<?php

namespace MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="main_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tours = $em->getRepository('MainBundle:Tours')
            ->getTours();

        $cards = $em->getRepository('MainBundle:AboutCards')
            ->getCards();

        $slider = $em->getRepository('MainBundle:HomeSlider')
            ->getSlider();

        $destinations = $em->getRepository('MainBundle:Destinations')
            ->getDestinations();

        $reviews = $em->getRepository('MainBundle:TourReviews');

        return $this->render('MainBundle:Main:index.html.twig',array(
            'tours' => $tours,
            'cards' => $cards,
            'slider' => $slider,
            'destinations' => $destinations,
            'reviews' => $reviews
        ));
    }

    /**
     * @Route("/tours", name="tours")
     */
    public function toursAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tours = $em->getRepository('MainBundle:Tours')
            ->getTours();

        $reviews = $em->getRepository('MainBundle:TourReviews');

        return $this->render('MainBundle:Main:tours.html.twig', array(
            'tours' => $tours,
            'reviews' => $reviews,
            'title' => 'Туры'
        ));
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $about = $em->getRepository('MainBundle:About')
            ->getAbout();

        $cards = $em->getRepository('MainBundle:AboutCards')
            ->getCards();

        $team = $em->getRepository('MainBundle:Team')
            ->getTeam();

        $teamSM = $em->getRepository('MainBundle:TeamSocialMedia');

        foreach ($about as $val)
        {
            $about = $val;
        }

        return $this->render('MainBundle:Main:about.html.twig', array(
            'about' => $about,
            'cards' => $cards,
            'team' => $team,
            'teamSM' => $teamSM,
            'title' => 'О нас'
        ));
    }

    /**
     * @Route("/destinations", name="destinations")
     */
    public function destinationsAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $destinations = $em->getRepository('MainBundle:Destinations')
            ->getDestinations();

        return $this->render('@Main/Main/destinations.html.twig', array(
            'title' => 'Локации',
            'destinations' => $destinations
        ));
    }

    /**
     * @Route("/search", name="search")
     * @return Response
     */
    public function searchAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $title = $_GET['search'];

        $tours = $em->getRepository('MainBundle:Tours')
            ->searchByTitle($title);

        return $this->render('@Main/Main/search.html.twig', array(
            'tours' => $tours,
            'title' => $title
        ));
    }

    public function footerAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $static = $em->getRepository('MainBundle:StaticInformation')
            ->getStatic();

        return $this->render('footer.html.twig', array(
            'static' => $static
        ));
    }
}
