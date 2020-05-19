<?php

namespace EventBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 */
class Event
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
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="short_text", type="text", nullable=true)
     */
    private $shortText;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="contacts", type="text", nullable=true)
     */
    private $contacts;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="dateRegistration", type="string", length=255, nullable=true)
     */
    private $dateRegistration;

    /**
     * @var string
     *
     * @ORM\Column(name="lastRegistration", type="string", length=255, nullable=true)
     */
    private $lastRegistration;

    /**
     *
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\EventGallery",
     *     mappedBy="event", cascade={"persist"})
     *
     */
    private $galleries;

    /**
     *
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\Entries",
     *     mappedBy="event", cascade={"persist"})
     *
     */
    private $entries;


    /**
     * @var int
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;


    public function __construct()
    {
        $this->galleries = new ArrayCollection();
        $this->published = true;
        $this->created = new \DateTime();
        $this->entries = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->title . "";
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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Event
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set contacts
     *
     * @param string $contacts
     * @return Event
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Get contacts
     *
     * @return string 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Event
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set dateRegistration
     *
     * @param string $dateRegistration
     * @return Event
     */
    public function setDateRegistration($dateRegistration)
    {
        $this->dateRegistration = $dateRegistration;

        return $this;
    }

    /**
     * Get dateRegistration
     *
     * @return string 
     */
    public function getDateRegistration()
    {
        return $this->dateRegistration;
    }

    /**
     * Set lastRegistration
     *
     * @param string $lastRegistration
     * @return Event
     */
    public function setLastRegistration($lastRegistration)
    {
        $this->lastRegistration = $lastRegistration;

        return $this;
    }

    /**
     * Get lastRegistration
     *
     * @return string 
     */
    public function getLastRegistration()
    {
        return $this->lastRegistration;
    }


    public function addGallery($entity)
    {
        $this->galleries->add($entity);
    }
    /**
     * @return mixed
     */
    public function getGalleries()
    {
        return $this->galleries;
    }

    /**
     * @param mixed $galleries
     */
    public function setGalleries($galleries)
    {
        $this->galleries = $galleries;
    }

    /**
     * @return int
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param int $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getShortText()
    {
        return $this->shortText;
    }

    /**
     * @param string $shortText
     */
    public function setShortText($shortText)
    {
        $this->shortText = $shortText;
    }

    /**
     * @return mixed
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param mixed $entries
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

    public function addEntries($entity)
    {
        $this->entries->add($entity);
        return $this->entries;
    }

}
