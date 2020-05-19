<?php


namespace MainBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ToursRepository")
 * @ORM\Table(name="tours")
 * @ORM\HasLifecycleCallbacks
 */
class Tours
{
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->tourDates = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="titleImage", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $titleImage;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TourImages", mappedBy="tour_id", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TourReviews", mappedBy="tour_id")
     */
    private $reviews;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $aboutTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $aboutText;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TourReservations", mappedBy="tour_id")
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Destinations", inversedBy="tours")
     */
    private $destination_id;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TourDates", mappedBy="tour_id", cascade={"persist"})
     */
    private $tourDates;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTitleImage()
    {
        return $this->titleImage;
    }

    /**
     * @param mixed $titleImage
     */
    public function setTitleImage($titleImage)
    {
        $this->titleImage = $titleImage;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAboutTitle()
    {
        return $this->aboutTitle;
    }

    /**
     * @param mixed $aboutTitle
     */
    public function setAboutTitle($aboutTitle)
    {
        $this->aboutTitle = $aboutTitle;
    }

    /**
     * @return mixed
     */
    public function getAboutText()
    {
        return $this->aboutText;
    }

    /**
     * @param mixed $aboutText
     */
    public function setAboutText($aboutText)
    {
        $this->aboutText = $aboutText;
    }

    /**
     * Add images
     *
     * @param TourImages $images
     * @return Tours
     */
    public function addImage(TourImages $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param TourImages $images
     */
    public function removeImage(TourImages $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Add reviews
     *
     * @param TourReviews $reviews
     * @return Tours
     */
    public function addReview(TourReviews $reviews)
    {
        $this->reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param TourReviews $reviews
     */
    public function removeReview(TourReviews $reviews)
    {
        $this->reviews->removeElement($reviews);
    }

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @param mixed $reservations
     */
    public function setReservations($reservations)
    {
        $this->reservations = $reservations;
    }

    public function addReservation(TourReservations $reservations)
    {
        $this->reservations[] = $reservations;

        return $this;
    }

    public function removeReservation(TourReservations $reservations)
    {
        $this->reservations->removeElement($reservations);
    }

    /**
     * @return mixed
     */
    public function getDestinationId()
    {
        return $this->destination_id;
    }

    /**
     * @param mixed $destination_id
     */
    public function setDestinationId($destination_id)
    {
        $this->destination_id = $destination_id;
    }

    /**
     * @return mixed
     */
    public function getTourDates()
    {
        return $this->tourDates;
    }

    /**
     * @param mixed $tourDates
     */
    public function setTourDates($tourDates)
    {
        $this->tourDates = $tourDates;
    }

    public function addTourDate(TourDates $tourDates)
    {
        $this->tourDates[] = $tourDates;

        return $this;
    }

    public function removeTourDate(TourDates $tourDates)
    {
        $this->tourDates->removeElement($tourDates);
    }
}
