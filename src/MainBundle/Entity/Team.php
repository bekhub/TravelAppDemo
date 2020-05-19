<?php

namespace MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TeamRepository")
 */
class Team
{
    public function __construct()
    {
        $this->socialMedias = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
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
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="team_image", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $teamImage;

    /**
     * @ORM\Column(name="full_name", type="string")
     */
    private $fullName;

    /**
     * @ORM\Column(name="position", type="string")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\TeamSocialMedia", mappedBy="team_id")
     */
    private $socialMedias;

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
    public function getTeamImage()
    {
        return $this->teamImage;
    }

    /**
     * @param mixed $teamImage
     */
    public function setTeamImage($teamImage)
    {
        $this->teamImage = $teamImage;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getSocialMedias()
    {
        return $this->socialMedias;
    }

    /**
     * @param mixed $socialMedias
     */
    public function setSocialMedias($socialMedias)
    {
        $this->socialMedias = $socialMedias;
    }
}
