<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Instrument
 *
 * @ORM\Table(name="instrument")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstrumentRepository")
 */
class Instrument
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
   * @var bool
   *
   * @ORM\Column(name="enabled", type="boolean")
   */
  private $enabled;

  /**
   * @ORM\ManyToMany(targetEntity="Room", inversedBy="instruments", cascade={"persist"})
   * @ORM\JoinTable(name="room_instrument")
   */
  private $rooms;

  /**
   * @ORM\ManyToMany(targetEntity="Tutor", inversedBy="instruments", cascade={"persist"})
   * @ORM\JoinTable(name="tutor_instrument")
   */
  private $tutors;

  function __construct()
  {
    $this->rooms = new ArrayCollection();
    $this->tutors = new ArrayCollection();
  }

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
   * @return Instrument
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
   * Set enabled.
   *
   * @param bool $enabled
   *
   * @return Instrument
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
   * Add room.
   *
   * @param \AppBundle\Entity\Room $room
   *
   * @return Instrument
   */
  public function addRoom(\AppBundle\Entity\Room $room)
  {
    if (!$this->rooms->contains($room)) {
      $this->rooms[] = $room;
      $room->addInstrument($this);
    }
    return $this;
  }

  /**
   * Remove room.
   *
   * @param \AppBundle\Entity\Room $room
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeRoom(\AppBundle\Entity\Room $room)
  {
    if ($this->rooms->contains($room)) {
      $this->rooms->removeElement($room);
      $room->removeRoom($this);
    }
    return $this;
  }

  /**
   * Get rooms.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getRooms()
  {
    return $this->rooms;
  }

  /**
   * Add tutor.
   *
   * @param \AppBundle\Entity\Tutor $tutor
   *
   * @return Instrument
   */
  public function addTutor(\AppBundle\Entity\Tutor $tutor)
  {
    $this->tutors[] = $tutor;

    return $this;
  }

  /**
   * Remove tutor.
   *
   * @param \AppBundle\Entity\Tutor $tutor
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeTutor(\AppBundle\Entity\Tutor $tutor)
  {
    return $this->tutors->removeElement($tutor);
  }

  /**
   * Get tutors.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getTutors()
  {
    return $this->tutors;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
