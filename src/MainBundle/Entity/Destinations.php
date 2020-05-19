<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Destinations
 *
 * @ORM\Table(name="destinations")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\DestinationsRepository")
 */
class Destinations
{
    public function __construct()
    {
        $this->tours = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getDestination();
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
     * @ORM\Column(type="string")
     */
    private $destination;

    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="destinationImage", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $destinationImage;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Tours", mappedBy="destination_id", cascade={"persist"})
     */
    private $tours;

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
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getDestinationImage()
    {
        return $this->destinationImage;
    }

    /**
     * @param mixed $destinationImage
     */
    public function setDestinationImage($destinationImage)
    {
        $this->destinationImage = $destinationImage;
    }

    /**
     * @return mixed
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * @param mixed $tours
     */
    public function setTours($tours)
    {
        $this->tours = $tours;
    }

    /**
     * Add reviews
     *
     * @param Tours $tours
     * @return Destinations
     */
    public function addTour(Tours $tours)
    {
        $this->tours[] = $tours;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param Tours $tours
     */
    public function removeTour(Tours $tours)
    {
        $this->tours->removeElement($tours);
    }
}
