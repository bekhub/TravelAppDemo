<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TourDatesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TourDatesRepository extends EntityRepository
{
    public function getTourDates($tour_id)
    {
        $qb = $this->createQueryBuilder('td')
            ->select('td')
            ->where('td.tour_id = :tour_id')
            ->addOrderBy('td.startDate', 'ASC')
            ->setParameter('tour_id', $tour_id);

        return $qb->getQuery()
            ->getResult();
    }
}
