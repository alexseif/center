<?php

namespace AppBundle\Repository;

/**
 * InstrumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InstrumentRepository extends \Doctrine\ORM\EntityRepository
{

  public function queryEnabled()
  {
    return $this->createQueryBuilder('i')
            ->where('i.enabled = true');
  }

}
