<?php

namespace ParticipantBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use CategoryBundle\Entity\Category;
use CategoryBundle\Entity\Club;
use CategoryBundle\Entity\Color;
use CategoryBundle\Entity\Country;
use CategoryBundle\Entity\Weight;
use Doctrine\ORM\Mapping as ORM;
use EventBundle\Entity\Event;

/**
 * Participant
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="ParticipantBundle\Repository\ParticipantRepository")
 */
class Participant
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Country", cascade={"persist"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $country;


    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;



    /**
     * @var Club
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Club", cascade={"persist"})
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $club;


    /**
     * @var string
     *
     * @ORM\Column(name="gi", type="string", length=255, nullable=true)
     */
    private $gi;


    /**
     * @var string
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;


    /**
     * @var $coach User
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="coach_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $coach;


    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category;

    /**
     * @var Weight
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Weight", cascade={"persist"})
     * @ORM\JoinColumn(name="weigth_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $categoryWeigth;


    /**
     * @var Color
     * @ORM\ManyToOne(targetEntity="CategoryBundle\Entity\Color", cascade={"persist"})
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $color;

    /**
     * @var $event Event
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Event", cascade={"persist"})
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $event;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_birth", type="date", nullable=true)
     */
    private $dateBirth;

    /**
     * @var integer
     *
     * @ORM\Column(name="weigth", type="decimal", scale=2, nullable=true)
     */
    private $weigth;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    private $gender;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;


    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id", onDelete="SET NULL")
     * })
     */

    private $photo;


    public function __construct()
    {
        $this->created = new \DateTime();
        $this->status = 'NOT PAID';
        $this->gi = false;
    }


    public function __toString()
    {
        return $this->firstname . " " . $this->lastname;
    }


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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param string $club
     */
    public function setClub($club)
    {
        $this->club = $club;
    }

    /**
     * @return string
     */
    public function getGi()
    {
        return $this->gi;
    }

    /**
     * @param string $gi
     */
    public function setGi($gi)
    {
        $this->gi = $gi;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return User
     */
    public function getCoach()
    {
        return $this->coach;
    }

    /**
     * @param User $coach
     */
    public function setCoach($coach)
    {
        $this->coach = $coach;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return Weight
     */
    public function getCategoryWeigth()
    {
        return $this->categoryWeigth;
    }

    /**
     * @param Weight $categoryWeigth
     */
    public function setCategoryWeigth($categoryWeigth)
    {
        $this->categoryWeigth = $categoryWeigth;
    }

    /**
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param Color $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return \DateTime
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * @param \DateTime $dateBirth
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;
    }

    /**
     * @return int
     */
    public function getWeigth()
    {
        return $this->weigth;
    }

    /**
     * @param int $weigth
     */
    public function setWeigth($weigth)
    {
        $this->weigth = $weigth;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

}
