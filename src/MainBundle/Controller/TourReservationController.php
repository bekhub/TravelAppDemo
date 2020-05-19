<?php

namespace MainBundle\Controller;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Entity\TourReservations;
use MainBundle\Form\TourReservationsType;
use Symfony\Component\HttpFoundation\Response;

class TourReservationController extends Controller
{
    public function newAction($tour_id)
    {
        $tour = $this->getTour($tour_id);

        $reservation = new TourReservations();
        $reservation->setTourId($tour);
        $form   = $this->createForm(TourReservationsType::class, $reservation);

        return $this->render('MainBundle:Reservation:form.html.twig', array(
            'reservation' => $reservation,
            'form'   => $form->createView(),
            'tourDates' => $tour->getTourDates(),
            'title' => $tour->getName()
        ));
    }

    /**
     * @Route("/reservation/{tour_id}", name="reservation_create")
     * @param Request $request
     * @param $tour_id
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, $tour_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $tour = $this->getTour($tour_id);

        $reservation  = new TourReservations();
        $reservation->setTourId($tour);
        $form = $this->createForm(TourReservationsType::class, $reservation);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $bookDate = $_POST['bookDate'];

            $reservation->setBookDate($bookDate);

            $message = Swift_Message::newInstance()
                ->setSubject('Бронирование')
                ->setFrom('travel.email.test.site@gmail.com')
                ->setTo('bekambkg@gmail.com')
                ->setBody($this->renderView('@Main/Reservation/email.html.twig', array(
                    'tour' => $reservation->getTourId(),
                    'id' => $reservation->getId(),
                    'name' => $reservation->getFullName(),
                    'email' => $reservation->getEmail(),
                    'phone' => $reservation->getPhone(),
                    'bookDate' => $reservation->getBookDate(),
                    'adults' => $reservation->getAdults(),
                    'kids' => $reservation->getKids(),
                    'message' => $reservation->getMessage()
                )),
                    'text/html');

            $this->get('mailer')->send($message);

            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', 'Бронирование прошло удачно! Спасибо что выбрали нас:)');

            return $this->redirect($this->generateUrl('tours_show', array(
                    'id' => $reservation->getTourId()->getId()))
            );
        }

        return $this->render('MainBundle:Reservation:create.html.twig', array(
            'tour' => $tour,
            'reservation' => $reservation,
            'form' => $form->createView(),
            'tourDates' => $tour->getTourDates(),
            'title' => $tour->getName()
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
