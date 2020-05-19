<?php

namespace MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DestinationToursController extends Controller
{
    /**
     * @Route("/destinations/{destination_id}", name="destination_show")
     * @param $destination_id
     * @return Response
     */
    public function showAction($destination_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $destination = $em->getRepository('MainBundle:Destinations')->find($destination_id);

        $reviews = $em->getRepository('MainBundle:TourReviews');

        if (!$destination) {
            throw $this->createNotFoundException('Unable to find this destination.');
        }

        $tours = $em->getRepository('MainBundle:Tours')
            ->getToursForDestination($destination->getId());

        return $this->render('MainBundle:Main:destination_tours.html.twig', array(
            'tours' => $tours,
            'destination' => $destination->getDestination(),
            'reviews' => $reviews,
            'title' => $destination->getDestination()
        ));
    }
}
