<?php


namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TourReviewsRepository extends EntityRepository
{
    public function getReviewsForTour($tourId, $approved = true)
    {
        $qb = $this->createQueryBuilder('tr')
            ->select('tr')
            ->where('tr.tour_id = :tour_id')
            ->addOrderBy('tr.createdAt', 'DESC')
            ->setParameter('tour_id', $tourId);

        if (false === is_null($approved))
            $qb->andWhere('tr.approved = :approved')
                ->setParameter('approved', $approved);

        return $qb->getQuery()
            ->getResult();
    }

    public function getReviewsCount($tourId)
    {
        $qb = $this->createQueryBuilder('tr')
            ->select('tr')
            ->where('tr.tour_id = :tour_id')
            ->andWhere('tr.approved = true')
            ->addOrderBy('tr.createdAt', 'DESC')
            ->setParameter('tour_id', $tourId);


        $qb = $qb->getQuery()
            ->getResult();

        return count($qb);
    }
}