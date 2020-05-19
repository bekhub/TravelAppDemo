<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TourDates
 *
 * @ORM\Table(name="tour_dates")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TourDatesRepository")
 */
class TourDates
{
    public function __construct()
    {
        $this->tour_reservation_id = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getStartDate()->format('d/m/Y') . ' - ' . $this->getEndDate()->format('d/m/Y');
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Tours", inversedBy="id")
     */
    private $tour_id;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TourReservations", mappedBy="bookDate")
     */
    private $tour_reservation_id;

    /**
     * @Assert\NotBlank()
     */
    public $bookDate;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getTourId()
    {
        return $this->tour_id;
    }

    /**
     * @param mixed $tour_id
     * @return TourDates
     */
    public function setTourId(Tours $tour_id = null)
    {
        $this->tour_id = $tour_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTourReservationId()
    {
        return $this->tour_reservation_id;
    }

    /**
     * @param mixed $tour_reservation_id
     */
    public function setTourReservationId($tour_reservation_id)
    {
        $this->tour_reservation_id = $tour_reservation_id;
    }
}
