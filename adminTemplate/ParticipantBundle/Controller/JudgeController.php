<?php

namespace ParticipantBundle\Controller;

use EventBundle\Entity\Event;
use MatchBundle\Entity\Matches;
use Negotiation\Match;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * JudgeController controller.
 *
 * @Route("/judge")
 * @Security("has_role('ROLE_USER')")
 */
class JudgeController extends Controller
{
    /**
     * @Route("/{id}/show", name="judge_show")
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



    /**
     * @Route("/{id}/change/{match}", name="judge_change_match")
     */
    public function changeAction(Event $event, Matches $match)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $color = $match->getColor();

        return $this->render('ParticipantBundle:Judge:change.html.twig', array(
            'user' => $user,
            'event' => $event,
            'match' => $match,
            'color' => $color,
            'weight' => $match->getWeigth()
        ));
    }
}
