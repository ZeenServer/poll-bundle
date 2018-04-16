<?php

namespace Zeen\ZeenPollBundle\Entity;


use Iphp\CoreBundle\Entity\BaseEntityRepository;

abstract class BasePollRepository extends BaseEntityRepository
{

    protected function getDefaultQueryBuilder(\Doctrine\ORM\EntityManager $em)
    {
        return new BasePollQueryBuilder($em);
    }


    public function getCurrent()
    {

          return $this->createQueryBuilder('p')->whereEnabled(true)->setMaxResults(1)
              ->getQuery()->getOneOrNullResult();
    }

}