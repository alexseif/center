<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 */
class Customer
{

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
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=255)
   */
  private $email;

  /**
   * @var string
   *
   * @ORM\Column(name="mobile", type="string", length=255)
   */
  private $mobile;

  /**
   * @var int|null
   *
   * @ORM\Column(name="discount", type="integer", nullable=true)
   */
  private $discount;

  /**
   * @ORM\OneToMany(targetEntity="Reservation", mappedBy="customer", cascade={"persist", "remove"})
   */
  private $reservations;

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
   * @return Customer
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
   * Set email.
   *
   * @param string $email
   *
   * @return Customer
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email.
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set mobile.
   *
   * @param string $mobile
   *
   * @return Customer
   */
  public function setMobile($mobile)
  {
    $this->mobile = $mobile;

    return $this;
  }

  /**
   * Get mobile.
   *
   * @return string
   */
  public function getMobile()
  {
    return $this->mobile;
  }

  /**
   * Set discount.
   *
   * @param int|null $discount
   *
   * @return Customer
   */
  public function setDiscount($discount = null)
  {
    $this->discount = $discount;

    return $this;
  }

  /**
   * Get discount.
   *
   * @return int|null
   */
  public function getDiscount()
  {
    return $this->discount;
  }

  public function __toString()
  {
    return $this->getName();
  }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reservation.
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Customer
     */
    public function addReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation.
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReservation(\AppBundle\Entity\Reservation $reservation)
    {
        return $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
