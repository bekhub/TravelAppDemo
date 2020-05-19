<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * StaticInformationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StaticInformationRepository extends EntityRepository
{
    public function getStatic()
    {
        $qb = $this->createQueryBuilder('si')
            ->select('si')
            ->addOrderBy('si.id', 'ASC');

        $static = $qb->getQuery()
            ->getResult();

        foreach ($static as $value)
        {
            $static = $value;
        }

        return $static;
    }
}