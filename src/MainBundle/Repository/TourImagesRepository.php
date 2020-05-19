<?php


namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TourImagesRepository extends EntityRepository
{
    public function getTourImages($tourId)
    {
        $qb = $this->createQueryBuilder('ti')
            ->select('ti')
            ->where('ti.tour_id = :tour_id')
            ->addOrderBy('ti.id')
            ->setParameter('tour_id', $tourId);

        return $qb->getQuery()
            ->getResult();
    }
}