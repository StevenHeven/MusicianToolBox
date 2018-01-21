<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OfferRepository extends EntityRepository
{

    public function findAllWithComponents(){
        $qb= $this->createQueryBuilder('offer')
            ->select('offer', 'adress', 'category', 'style', 'musician', 'instrument', 'image' )
            ->leftJoin('offer.adress', 'adress')
            ->leftJoin('offer.category', 'category')
            ->leftJoin('offer.style', 'style')
            ->leftJoin('offer.musician', 'musician')
            ->leftJoin('offer.instrument', 'instrument')
            ->leftJoin('offer.image', 'image')
            ->orderBy('offer.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function findWithPictures($id){
        $qb= $this->createQueryBuilder('offer')
            ->select('offer', 'image', 'adress', 'category', 'style', 'musician', 'instrument', 'user')
            ->leftJoin('offer.image', 'image')
            ->leftJoin('offer.adress', 'adress')
            ->leftJoin('offer.category', 'category')
            ->leftJoin('offer.style', 'style')
            ->leftJoin('offer.musician', 'musician')
            ->leftJoin('offer.instrument', 'instrument')
            ->leftJoin('offer.user', 'user')
            ->where('offer.id = :id')
            ->orderBy('image.id', 'ASC')
            ->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}