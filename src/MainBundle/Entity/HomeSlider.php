<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeSlider
 *
 * @ORM\Table(name="home_slider")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\HomeSliderRepository")
 */
class HomeSlider
{
    public function __toString()
    {
        return $this->getTitle();
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link = "/tours";

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $linkName = "Все туры";

    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="sliderImage", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $sliderImage;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getSliderImage()
    {
        return $this->sliderImage;
    }

    /**
     * @param mixed $sliderImage
     */
    public function setSliderImage($sliderImage)
    {
        $this->sliderImage = $sliderImage;
    }

    /**
     * @return mixed
     */
    public function getLinkName()
    {
        return $this->linkName;
    }

    /**
     * @param mixed $linkName
     */
    public function setLinkName($linkName)
    {
        $this->linkName = $linkName;
    }


}
