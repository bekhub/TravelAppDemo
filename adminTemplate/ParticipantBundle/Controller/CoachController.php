<?php

namespace ParticipantBundle\Controller;

use EventBundle\Entity\Event;
use Negotiation\Match;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * CoachController controller.
 *
 * @Route("/coach")
 * @Security("has_role('ROLE_USER')")
 */
class CoachController extends Controller
{

    /**
     * @Route("/{id}/show", name="coach_show")
     */
    public function indexAction(Event $event)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $participants = $em->getRepository('ParticipantBundle:Participant')
            ->findBy(array('coach' => $user), array('id' => 'DESC'));


        return $this->render('ParticipantBundle:Coach:index.html.twig', array(
            'user' => $user,
            'event' => $event,
            'participants' => $participants
        ));
    }


}
