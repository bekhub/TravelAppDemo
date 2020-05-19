<?php

namespace Application\Sonata\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sonata\MediaBundle\Controller\MediaController as BaseController;

class MediaController extends BaseController
{
    public function deleteMediaAction($id)
    {
//        if ($id == null){
//            dump();
//            die('keldi');
//        }
        $em                          = $this->getDoctrine()->getManager();
        $media                       = $em->getRepository('ApplicationSonataMediaBundle:Media')->find($id);
        $entities                    = array();
        $array                       = array();
        $entities['product_photo']   = 'ProductBundle:ProductGallery';
        $array[$media->getContext()] = 'does not have gallery';
        if (array_intersect_key($entities, $array)) {
            $entity = $em->getRepository($entities[$media->getContext()])->findOneByMedia($media);

//            dump($entities[$media->getContext()],$media,$entity);
//            die('keldi if');
        } else {
            $entity = $media;
//            dump($media->getContext());
//            die('keldi else');
        }
        if ($entity) {

//            $portfolioGallery = $em->getRepository('Product')
//                ->findOneByPhoto($media);
//            dump($entity,$portfolioGallery);
//            die('keldi if entity');
//            $em->remove($portfolioGallery);
            $em->remove($entity);
            $em->flush();

            return new Response(1);
        }

        return new Response(0);
    }

}
