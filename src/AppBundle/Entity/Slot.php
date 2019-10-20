<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Slot
 *
 * @ORM\Table(name="slot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SlotRepository")
 */
class Slot
{

  use TimestampableEntity;

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
   * @var \DateTime
   *
   * @ORM\Column(name="startAt", type="datetime")
   */
  private $startAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="endAt", type="datetime")
   */
  private $endAt;

  /**
   * @ORM\ManyToOne(targetEntity="Room")
   * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
   */
  private $room;

  /**
   * @ORM\ManyToOne(targetEntity="Instrument")
   * @ORM\JoinColumn(name="instrument_id", referencedColumnName="id")
   */
  private $instrument;

  /**
   * @ORM\ManyToOne(targetEntity="Tutor")
   * @ORM\JoinColumn(name="tutor_id", referencedColumnName="id")
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
   * @return Slot
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
   * Set startAt.
   *
   * @param \DateTime $startAt
   *
   * @return Slot
   */
  public function setStartAt($startAt)
  {
    $this->startAt = $startAt;

    return $this;
  }

  /**
   * Get startAt.
   *
   * @return \DateTime
   */
  public function getStartAt()
  {
    return $this->startAt;
  }

  /**
   * Set endAt.
   *
   * @param \DateTime $endAt
   *
   * @return Slot
   */
  public function setEndAt($endAt)
  {
    $this->endAt = $endAt;

    return $this;
  }

  /**
   * Get endAt.
   *
   * @return \DateTime
   */
  public function getEndAt()
  {
    return $this->endAt;
  }

  /**
   * Set room.
   *
   * @param \AppBundle\Entity\room|null $room
   *
   * @return Slot
   */
  public function setRoom(\AppBundle\Entity\room $room = null)
  {
    $this->room = $room;

    return $this;
  }

  /**
   * Get room.
   *
   * @return \AppBundle\Entity\room|null
   */
  public function getRoom()
  {
    return $this->room;
  }

  /**
   * Set instrument.
   *
   * @param \AppBundle\Entity\instrument|null $instrument
   *
   * @return Slot
   */
  public function setInstrument(\AppBundle\Entity\instrument $instrument = null)
  {
    $this->instrument = $instrument;

    return $this;
  }

  /**
   * Get instrument.
   *
   * @return \AppBundle\Entity\instrument|null
   */
  public function getInstrument()
  {
    return $this->instrument;
  }

  /**
   * Set tutor.
   *
   * @param \AppBundle\Entity\tutor|null $tutor
   *
   * @return Slot
   */
  public function setTutor(\AppBundle\Entity\tutor $tutor = null)
  {
    $this->tutor = $tutor;

    return $this;
  }

  /**
   * Get tutor.
   *
   * @return \AppBundle\Entity\tutor|null
   */
  public function getTutor()
  {
    return $this->tutor;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
