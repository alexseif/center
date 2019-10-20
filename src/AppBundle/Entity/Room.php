<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
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
   * @ORM\ManyToMany(targetEntity="Instrument", mappedBy="rooms", cascade={"persist"})
   */
  private $instruments;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->instruments = new ArrayCollection();
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
   * @return Room
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
   * @return Room
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
   * Add instrument.
   *
   * @param \AppBundle\Entity\Instrument $instrument
   *
   * @return Room
   */
  public function addInstrument(\AppBundle\Entity\Instrument $instrument)
  {
    if (!$this->instruments->contains($instrument)) {
      $this->instruments[] = $instrument;
      $instrument->addRoom($this);
    }
    return $this;
  }

  /**
   * Remove instrument.
   *
   * @param \AppBundle\Entity\Instrument $instrument
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeInstrument(\AppBundle\Entity\Instrument $instrument)
  {
    if ($this->instruments->contains($instrument)) {
      $this->instruments->removeElement($instrument);
      $instrument->removeRoom($this);
    }
    return $this;
  }

  /**
   * Get instruments.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getInstruments()
  {
    return $this->instruments;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
