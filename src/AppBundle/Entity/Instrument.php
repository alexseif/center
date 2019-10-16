<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

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
   * @ORM\ManyToOne(targetEntity="Room", inversedBy="instruments")
   * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
   */
  private $availableRooms;

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
   * Set availableRooms.
   *
   * @param \AppBundle\Entity\Room|null $availableRooms
   *
   * @return Instrument
   */
  public function setAvailableRooms(\AppBundle\Entity\Room $availableRooms = null)
  {
    $this->availableRooms = $availableRooms;

    return $this;
  }

  /**
   * Get availableRooms.
   *
   * @return \AppBundle\Entity\Room|null
   */
  public function getAvailableRooms()
  {
    return $this->availableRooms;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
