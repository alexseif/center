<?php

namespace AppBundle\Repository;

/**
 * RoomRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoomRepository extends \Doctrine\ORM\EntityRepository
{

  public function queryEnabled()
  {
    return $this->createQueryBuilder('r')
            ->where('r.enabled = true');
  }

}
