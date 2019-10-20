<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Tutor
 *
 * @ORM\Table(name="tutor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TutorRepository")
 */
class Tutor
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
   * @ORM\ManyToMany(targetEntity="Instrument", mappedBy="tutors", cascade={"persist"})
   */
  private $instruments;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->instruments = new \Doctrine\Common\Collections\ArrayCollection();
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
   * @return Tutor
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
   * @return Tutor
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
   * @return Tutor
   */
  public function addInstrument(\AppBundle\Entity\Instrument $instrument)
  {
    $this->instruments[] = $instrument;

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
    return $this->instruments->removeElement($instrument);
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
