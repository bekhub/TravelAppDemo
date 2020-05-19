<?php


namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ToursRepository extends EntityRepository
{
    public function getTours($limit = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->addOrderBy('t.id', 'ASC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }

    public function getToursForDestination($destination_id)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.destination_id = :destination_id')
            ->addOrderBy('t.id', 'ASC')
            ->setParameter('destination_id', $destination_id);

        return $qb->getQuery()
            ->getResult();
    }

    public function searchByTitle($title)
    {
        if ($title) {
            $qb = $this->createQueryBuilder('t')
                ->select('t')
                ->where('t.title LIKE :title')
                ->orWhere('t.aboutText LIKE :title')
                ->setParameter('title', '%' . $title . '%');

            return $qb->getQuery()
                ->getResult();
        }

        return $this;
    }
}