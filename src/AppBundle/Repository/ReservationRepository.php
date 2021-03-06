<?php

namespace AppBundle\Repository;

/**
 * ResrvationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends \Doctrine\ORM\EntityRepository
{

  public function getByDay(\DateTime $day)
  {
    return $this->createQueryBuilder('r')
            ->where('r.start >= :day')
            ->setParameter(':day', $day->format('Y-m-d'))
            ->getQuery()
            ->getResult();
  }

  public function getByRange(\DateTime $start, \DateTime $end)
  {
    return $this->createQueryBuilder('r')
            ->where('r.start >= :start')
            ->andWhere('r.start <= :end')
            ->setParameter(':start', $start->format('Y-m-d'))
            ->setParameter(':end', $end->format('Y-m-d'))
            ->getQuery()
            ->getResult();
  }

  public function findAllWithJoins()
  {
    return $this->createQueryBuilder('r')
            ->select('r, c, cp')
            ->leftJoin('r.customer', 'c')
            ->leftJoin('r.course', 'cp')
            ->getQuery()
            ->getResult();
  }

}
