<?php

namespace ParticipantBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use CategoryBundle\Entity\Color;
use CategoryBundle\Entity\Weight;
use EventBundle\Entity\Event;
use MatchBundle\Entity\Matches;
use Negotiation\Match;
use ParticipantBundle\Entity\Participant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * OrganizerController controller.
 * @Security("has_role('ROLE_USER')")
 */
class OrganizerController extends Controller
{
    /**
     * @Route("/organizer/{event}/{weight}/{color}", name="organizer_create_match")
     */
    public function createMatchesAction(Event $event, Weight $weight, Color $color)
    {
        /** @var $user User */
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $participants = $em->getRepository('ParticipantBundle:Participant')
            ->findBy(array('event' => $event, 'categoryWeigth' => $weight, 'color' => $color), array('number' => 'DESC'));

        if (!$user->getOrganizer()){
            return $this->redirectToRoute('event_participant_list', array(
                'id' => $event->getId()
            ));
        }

        $matches = $em->getRepository('MatchBundle:Matches')
            ->findBy(array('weigth' => $weight->getCategory(), 'color' => $color, 'weigth' => $weight), array('id' => 'ASC'));


        $added = array();
        $stages = array();

        if ($matches){
            foreach ($matches as $match){
                if ( !array_key_exists($match->getStage(), $added) ){   //!$added[$match->getStage()]){
                    $stages[] = $match->getStage();
                    $added[$match->getStage()] = true;
                }
            }
        }else{
            $data = $this->generateMatches($event, $weight, $color, $participants);
            $matches = $data['matches'];
            $stages = $data['stages'];
        }


        return $this->render('ParticipantBundle:Organizer:index.html.twig', array(
            'user' => $user,
            'event' => $event,
            'participants' => $participants,
            'matches' => $matches,
            'stages' => $stages,
            'color' => $color,
            'weight' => $weight
        ));
    }


    private function generateMatches(Event $event, Weight $weight, Color $color, $participants)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var $participants Participant|Participant[] */
        $count = sizeof($participants);

        $matches = array();
        $numberMatch = 1;
        $allMatch = $this->allCount($count);
        $stages = array();

        $k = 1;

        for ($i = 2; $i <= $allMatch; $i = $i * 2){

            if ($i == $allMatch) $stage = "Final";
            else if ($i == $allMatch / 2) $stage = "Semi final";
            else if ($i == $allMatch / 4) $stage = "Quarter final";
            else $stage = "1 / " . $allMatch / $i;

            $stages[] = $stage;

            for ($j = 0; $j < $allMatch / $i; $j++){

                $match = new Matches();
                $match->setNumber($numberMatch);
                $match->setStage($stage);
                $match->setColor($color);
                $match->setWeigth($weight);
                $match->setCategory($weight->getCategory());

                if ($i != 2){
                    $match->setBeforeMatch1($k);
                    $match->setBeforeMatch2($k + 1);
                    $k += 2;
                }
                $numberMatch++;
                $em->persist($match);

                $matches[] = $match;

            }
        }

        $em->flush();

        $number = 0;
        $countMatch = 0;
        $count = sizeof($participants);


        for($i = 0, $j = 0; $i < $count; $i++, $j++){
            $number++;
            $countMatch++;

            if (($allMatch / 2) - $countMatch == ($count - 1 - $i)){

                $matches[$j]->setPlayer1($participants[$i]);
                $matches[$j]->setWinner($participants[$i]);

            }else{
                $matches[$j]->setPlayer1($participants[$i]);
                $matches[$j]->setPlayer2($participants[$i+1]);
                $i++;

            }

            $em->persist($matches[$j]);
        }
        $em->flush();

        /** @var $matches Matches|Matches[] */
        for($i = 0; $i < sizeof($matches); $i++){
            if (!$matches[$i]->getPlayer1() && !$matches[$i]->getPlayer2() && !$matches[$i]->getWinner()){
                $matches[$i]->setPlayer1($this->findPlayer($matches, $i, "player1"));
                $matches[$i]->setPlayer2($this->findPlayer($matches, $i, "player2"));
            }
            $em->persist($matches[$i]);
        }

        $em->flush();


        $data['stages'] = $stages;
        $data['matches'] = $matches;

        return $data;

    }


    private function findPlayer($matches, $number, $player)
    {
        /** @var $matches Matches|Matches[] */
        /** @var $match Matches */

        $match = $matches[$number];

        for ($i = 0; $i < sizeof($matches); $i++){

            if ( $matches[$i]->getNumber() == $match->getBeforeMatch1() && $player == 'player1'){
                return $matches[$i]->getWinner();
            }

            if ( $matches[$i]->getNumber() == $match->getBeforeMatch2() && $player == 'player2'){
                return $matches[$i]->getWinner();
            }

        }

        return $match->getWinner();
    }


    private function allCount($count)
    {
        $i = 1;
        while ($count > $i){
            $i = $i * 2;
        }
        return $i;
    }
}
