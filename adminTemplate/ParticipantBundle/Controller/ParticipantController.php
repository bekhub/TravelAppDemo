<?php

namespace ParticipantBundle\Controller;

use CategoryBundle\Entity\Category;
use EventBundle\Entity\Event;
use EventBundle\Entity\EventParticipants;
use ParticipantBundle\Entity\Participant;
use ParticipantBundle\Form\ParticipantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Participant controller.
 *
 * @Route("/coache/participant/{event}")
 * @Security("has_role('ROLE_USER')")
 *
 */
class ParticipantController extends Controller
{
    /**
     * @Route("/new", name="participant_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Event $event)
    {
        $participant = new Participant();
        $participant->setEvent($event);

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ParticipantType(), $participant);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $colorId = $request->request->get('participant_color');

            if ($colorId){
                $color = $em->getRepository('CategoryBundle:Color')->find($colorId);
                $participant->setColor($color);
            }
            $weightId = $request->request->get('participant_weigth');
            if ($weightId){
                $weight = $em->getRepository('CategoryBundle:Weight')->find($weightId);
                $participant->setCategoryWeigth($weight);
            }
//            $participant->setGi('giNo');

            $participant->setCoach($this->getUser());
            $participant->setNumber($this->getNumber($participant));

            $newPar = new Participant();
            $newPar->setCategory($participant->getCategory());
            $newPar->setEvent($participant->getEvent());
            $newPar->setCoach($participant->getCoach());
            $newPar->setClub($participant->getClub());
            $newPar->setCountry($participant->getCountry());
            $newPar->setDateBirth($participant->getDateBirth());
            $newPar->setFirstname($participant->getFirstname());
            $newPar->setLastname($participant->getLastname());
            $newPar->setGender($participant->getGender());
            $newPar->setPhoto($participant->getPhoto());
            $newPar->setTitle($participant->getTitle());
            $newPar->setWeigth($participant->getWeigth());
            $newPar->setNumber($this->getNumber($participant));
            $newPar->setCategoryWeigth($participant->getCategoryWeigth());
            $newPar->setColor($participant->getColor());
            $giId = $participant->getGi();
            if ($giId == 'giNoGi')
            {
                $newPar->setGi('gi');
                $participant->setGi('noGi');
                $em->persist($newPar);
                $em->flush();
                $em->persist($participant);
                $em->flush($participant);

            }
            else{
                $em->persist($participant);
                $em->flush($participant);

            }

//            dump($participant, $newPar);
//            die();
            return $this->redirectToRoute('coach_show', array('id' => $event->getId()));
        }

        return $this->render(
            'ParticipantBundle:Participant:new.html.twig',
            array(
                'participant' => $participant,
                'event'       => $event,
                'form'        => $form->createView(),
                'user'        => $this->getUser(),
            )
        );
    }


    /**
     * Finds and displays a participant entity.
     *
     * @Route("/{id}", name="participant_show")
     * @Method("GET")
     */
    public function showAction(Participant $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);

        return $this->render(
            'ParticipantBundle:Participant:new.html.twig',
            array(
                'participant' => $participant,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing participant entity.
     *
     * @Route("/{id}/edit", name="participant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Participant $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);
        $editForm   = $this->createForm('ParticipantBundle\Form\ParticipantType', $participant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {


            return $this->redirectToRoute('participant_edit', array('id' => $participant->getId()));
        }

        return $this->render(
            'participant/edit.html.twig',
            array(
                'participant' => $participant,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a participant entity.
     *
     * @Route("/{id}", name="participant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Participant $participant)
    {
        $form = $this->createDeleteForm($participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush($participant);
        }

        return $this->redirectToRoute('participant_index');
    }

    /**
     * Creates a form to delete a participant entity.
     *
     * @param Participant $participant The participant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Participant $participant)
    {
        return $this->createFormBuilder()->setAction(
                $this->generateUrl('participant_delete', array('id' => $participant->getId()))
            )->setMethod('DELETE')->getForm();
    }


    private function getNumber(Participant $participant)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParticipantBundle:Participant')->findBy(
                array(
                    'event'          => $participant->getEvent(),
                    'category'       => $participant->getCategory(),
                    'categoryWeigth' => $participant->getCategoryWeigth(),
                )
            );


        $in = array();
        foreach ($entities as $entity) {
            $in[] = $entity->getNumber();
        }

        do {
            $randomNumber = rand(1, max(100, sizeof($entities)));
        } while (in_array($randomNumber, $in));

        return $randomNumber;
    }

    /**
     * @Route("/select/category/{id}", name="select_category_asd", options={"expose"=true})
     */
    public function selectCategoryAction(Category $id)
    {
        dump("asd");
        die();
    }

}
