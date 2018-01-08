<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ConcertRepository extends EntityRepository
{

    public function findAllWithComponents()
    {
       $qb= $this->createQueryBuilder('concert')
           -> select('concert', 'liveroom')
           -> leftJoin('concert.liveroom', 'liveroom');

       return $qb->getQuery()->getResult();
    }

}