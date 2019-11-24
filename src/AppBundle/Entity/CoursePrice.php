<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * CoursePrice
 *
 * @ORM\Table(name="course_price")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoursePriceRepository")
 * @Gedmo\Loggable()
 */
class CoursePrice
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
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @var float
   *
   * @ORM\Column(name="price", type="float")
   * @Gedmo\Versioned()
   */
  private $price;

  /**
   * @ORM\OneToMany(targetEntity="Reservation", mappedBy="course", cascade={"persist", "remove"})
   */
  private $reservations;

  /**
   * @var bool
   *
   * @ORM\Column(name="enabled", type="boolean")
   */
  private $enabled = true;

  /**
   * @ORM\ManyToOne(targetEntity="Course", inversedBy="prices")
   * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
   */
  private $course;

  /**
   * @ORM\OneToOne(targetEntity="Instrument", inversedBy="coursePrice", cascade={"persist"})
   * @ORM\JoinColumn(name="instrument_id", referencedColumnName="id", nullable=false)
   */
  private $instrument;

  /**
   * @ORM\OneToOne(targetEntity="Tutor", inversedBy="coursePrice", cascade={"persist"})
   * @ORM\JoinColumn(name="tutor_id", referencedColumnName="id", nullable=false)
   */
  private $tutor;

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
   * Set name.
   *
   * @param string $name
   *
   * @return CoursePrice
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name.
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set price.
   *
   * @param float $price
   *
   * @return CoursePrice
   */
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get price.
   *
   * @return float
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set enabled.
   *
   * @param bool $enabled
   *
   * @return CoursePrice
   */
  public function setEnabled($enabled)
  {
    $this->enabled = $enabled;

    return $this;
  }

  /**
   * Get enabled.
   *
   * @return bool
   */
  public function getEnabled()
  {
    return $this->enabled;
  }

  /**
   * Set instrument.
   *
   * @param \AppBundle\Entity\Instrument $instrument
   *
   * @return CoursePrice
   */
  public function setInstrument(\AppBundle\Entity\Instrument $instrument)
  {
    $this->instrument = $instrument;

    return $this;
  }

  /**
   * Get instrument.
   *
   * @return \AppBundle\Entity\Instrument
   */
  public function getInstrument()
  {
    return $this->instrument;
  }

  /**
   * Set tutor.
   *
   * @param \AppBundle\Entity\Tutor $tutor
   *
   * @return CoursePrice
   */
  public function setTutor(\AppBundle\Entity\Tutor $tutor)
  {
    $this->tutor = $tutor;

    return $this;
  }

  /**
   * Get tutor.
   *
   * @return \AppBundle\Entity\Tutor
   */
  public function getTutor()
  {
    return $this->tutor;
  }

  /**
   * Set course.
   *
   * @param \AppBundle\Entity\Course|null $course
   *
   * @return CoursePrice
   */
  public function setCourse(\AppBundle\Entity\Course $course = null)
  {
    $this->course = $course;

    return $this;
  }

  /**
   * Get course.
   *
   * @return \AppBundle\Entity\Course|null
   */
  public function getCourse()
  {
    return $this->course;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
