<?php

namespace ParticipantBundle\Controller;

use CategoryBundle\Entity\Category;
use DateTime;
use ParticipantBundle\Entity\Participant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AjaxController
 * @package ParticipantBundle\Controller
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Route("/category/{id}/{gender}/{event}", name="category",  options={"expose"=true})
     */
    public function categoryAction($id, $gender, $event)
    {
//        $id='2000';
//        $stringDate = $id . "-01-01";
//        $date = new DateTime($stringDate );
//        dump($id,$gender);
//        die();
        $categories = $this->getDoctrine()
            ->getRepository('CategoryBundle:Category')
            ->createQueryBuilder('c')
            ->select('c.title', 'c.id')


//            ->where('c.startDate <=:date')
//            ->where(':date <= c.startDate')
            ->where(':date BETWEEN c.startDate AND c.endDate')
            ->andWhere('c.gender =:gender')
            ->andWhere('c.event =:event')
            ->setParameter('date', $id)
            ->setParameter('gender', $gender)
            ->setParameter('event', $event)
            ->getQuery()
            ->getResult();
//        dump($category);
//        dump($id);
//        dump($gender);
//        die();


        return new JsonResponse($categories);

//        return $this->render('ParticipantBundle:Ajax:listCategory.html.twig',
//            array('category'=>$category));
    }

    /**
     * @Route("/ajax/{id}", name="bireki",  options={"expose"=true})
     */
    public function birAction(Category $id)
    {
        $weight = $this->getDoctrine()->getRepository('CategoryBundle:Weight')
            ->findByCategory($id);


        return $this->render('ParticipantBundle:Ajax:listWeight.html.twig',
            array('weight'=>$weight));
    }
    /**
     * @Route("/uch/{id}", name="birekiuch",  options={"expose"=true})
     */
    public function ekiAction(Category $id)
    {

        return $this->render('ParticipantBundle:Ajax:listColor.html.twig',
            array('color'=>$id->getColors()));
    }
}
