<?php

namespace UserBundle\Document;

use Sonata\UserBundle\Document\BaseGroup as BaseGroup;

/**
 * This file has been generated by the SonataEasyExtendsBundle.
 *
 * @link https://sonata-project.org/easy-extends
 *
 * References:
 * @link http://www.doctrine-project.org/docs/mongodb_odm/1.0/en/reference/working-with-objects.html
 */
class Group extends BaseGroup
{

  /**
   * @var int $id
   */
  protected $id;

  /**
   * Get id.
   *
   * @return int $id
   */
  public function getId()
  {
    return $this->id;
  }

}