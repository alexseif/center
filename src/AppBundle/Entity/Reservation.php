<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * Reservation
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
   * @ORM\ManyToOne(targetEntity="Room", inversedBy="reservations")
   * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
   */
  private $room;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="start", type="datetime")
   */
  private $start;

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

  /**
   * Set room.
   *
   * @param \AppBundle\Entity\Room|null $room
   *
   * @return Reservation
   */
  public function setRoom(\AppBundle\Entity\Room $room = null)
  {
    $this->room = $room;

    return $this;
  }

  /**
   * Get room.
   *
   * @return \AppBundle\Entity\Room|null
   */
  public function getRoom()
  {
    return $this->room;
  }

}
