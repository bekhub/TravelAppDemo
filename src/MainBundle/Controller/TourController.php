<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MainBundle\Entity\Tours;
use MainBundle\Repository\ToursRepository;

class TourController extends Controller
{
    /**
     * @Route("/tours/{id}", name="tours_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tour = $em->getRepository('MainBundle:Tours')->find($id);

        if (!$tour) {
            throw $this->createNotFoundException('Unable to find this tour.');
        }

        $reviews = $em->getRepository('MainBundle:TourReviews')
            ->getReviewsForTour($tour->getId());

        $images = $em->getRepository('MainBundle:TourImages')
            ->getTourImages($tour->getId());

        $static = $em->getRepository('MainBundle:StaticInformation')
            ->getStatic();

        foreach ($static as $value)
        {
            $static = $value;
        }

        return $this->render('MainBundle:Main:show.html.twig', array(
            'tour' => $tour,
            'reviews' => $reviews,
            'images' =>$images,
            'static' => $static,
            'title' => $tour->getName()
        ));
    }
}
