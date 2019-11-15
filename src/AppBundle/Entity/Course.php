<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course
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
   * @var int
   *
   * @ORM\Column(name="days", type="integer")
   */
  private $days;

  /**
   * @var bool
   *
   * @ORM\Column(name="enabled", type="boolean")
   */
  private $enabled = true;

  /**
   * @ORM\OneToMany(targetEntity="CoursePrice", mappedBy="course", cascade={"persist", "remove"})
   */
  private $prices;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
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
   * @return Course
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
   * Set days.
   *
   * @param int $days
   *
   * @return Course
   */
  public function setDays($days)
  {
    $this->days = $days;

    return $this;
  }

  /**
   * Get days.
   *
   * @return int
   */
  public function getDays()
  {
    return $this->days;
  }

  /**
   * Set enabled.
   *
   * @param bool $enabled
   *
   * @return Course
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
   * Add price.
   *
   * @param \AppBundle\Entity\CoursePrice $price
   *
   * @return Course
   */
  public function addPrice(\AppBundle\Entity\CoursePrice $price)
  {
    $this->prices[] = $price;

    return $this;
  }

  /**
   * Remove price.
   *
   * @param \AppBundle\Entity\CoursePrice $price
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removePrice(\AppBundle\Entity\CoursePrice $price)
  {
    return $this->prices->removeElement($price);
  }

  /**
   * Get prices.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getPrices()
  {
    return $this->prices;
  }

  public function __toString()
  {
    return $this->getName();
  }

}
