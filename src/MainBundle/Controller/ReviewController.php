<?php

namespace MainBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Entity\TourReviews;
use MainBundle\Form\TourReviewsType;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function newAction($tour_id)
    {
        $tour = $this->getTour($tour_id);

        $review = new TourReviews();
        $review->setTourId($tour);
        $form   = $this->createForm(TourReviewsType::class, $review);

        return $this->render('MainBundle:Review:form.html.twig', array(
            'review' => $review,
            'form'   => $form->createView(),
            'title' => 'Отзывы'
        ));
    }

    /**
     * @Route("/review/{tour_id}", name="review_create")
     * @param Request $request
     * @param $tour_id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, $tour_id)
    {
        $tour = $this->getTour($tour_id);

        $review  = new TourReviews();
        $review->setTourId($tour);
        $form = $this->createForm(TourReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirect($this->generateUrl('tours_show', array(
                    'id' => $review->getTourId()->getId())) . '#review-' . $review->getId()
            );
        }

        return $this->render('MainBundle:Review:create.html.twig', array(
            'review' => $review,
            'form' => $form->createView(),
            'title' => 'Отзывы'
        ));
    }

    protected function getTour($tour_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tour = $em->getRepository('MainBundle:Tours')->find($tour_id);

        if (!$tour) {
            throw $this->createNotFoundException('Unable to find this tour.');
        }

        return $tour;
    }
}
