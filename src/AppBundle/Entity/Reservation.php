<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * Resrvation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
{

  use TimestampableEntity;
  use BlameableEntity;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\ManyToOne(targetEntity="Customer", inversedBy="reservations")
   * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
   */
  private $customer;

  /**
   * @ORM\ManyToOne(targetEntity="CoursePrice", inversedBy="reservations")
   * @ORM\JoinColumn(name="course_price_id", referencedColumnName="id")
   */
  private $course;

  /**
   * @var \stdClass
   *
   * @ORM\Column(name="slot", type="object")
   */
  private $slot;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="start", type="datetime")
   */
  private $start;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="end", type="datetime")
   */
  private $end;

  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set slot.
   *
   * @param \stdClass $slot
   *
   * @return Resrvation
   */
  public function setSlot($slot)
  {
    $this->slot = $slot;

    return $this;
  }

  /**
   * Get slot.
   *
   * @return \stdClass
   */
  public function getSlot()
  {
    return $this->slot;
  }

  /**
   * Set start.
   *
   * @param \DateTime $start
   *
   * @return Resrvation
   */
  public function setStart($start)
  {
    $this->start = $start;

    return $this;
  }

  /**
   * Get start.
   *
   * @return \DateTime
   */
  public function getStart()
  {
    return $this->start;
  }

  /**
   * Set end.
   *
   * @param \DateTime $end
   *
   * @return Resrvation
   */
  public function setEnd($end)
  {
    $this->end = $end;

    return $this;
  }

  /**
   * Get end.
   *
   * @return \DateTime
   */
  public function getEnd()
  {
    return $this->end;
  }

  /**
   * Set customer.
   *
   * @param \AppBundle\Entity\Customer|null $customer
   *
   * @return Reservation
   */
  public function setCustomer(\AppBundle\Entity\Customer $customer = null)
  {
    $this->customer = $customer;

    return $this;
  }

  /**
   * Get customer.
   *
   * @return \AppBundle\Entity\Customer|null
   */
  public function getCustomer()
  {
    return $this->customer;
  }

  /**
   * Set course.
   *
   * @param \AppBundle\Entity\CoursePrice|null $course
   *
   * @return Reservation
   */
  public function setCourse(\AppBundle\Entity\CoursePrice $course = null)
  {
    $this->course = $course;

    return $this;
  }

  /**
   * Get course.
   *
   * @return \AppBundle\Entity\CoursePrice|null
   */
  public function getCourse()
  {
    return $this->course;
  }

}
