<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AboutCards
 *
 * @ORM\Table(name="about_cards")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AboutCardsRepository")
 */
class AboutCards
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
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="icon", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $icon;

    /**
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @ORM\Column(name="card_name", type="string")
     */
    private $cardName;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\About", inversedBy="cards")
     * @ORM\JoinColumn(name="about_id", referencedColumnName="id")
     */
    private $about_id;

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
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getCardName()
    {
        return $this->cardName;
    }

    /**
     * @param mixed $cardName
     */
    public function setCardName($cardName)
    {
        $this->cardName = $cardName;
    }

    /**
     * @return mixed
     */
    public function getAboutId()
    {
        return $this->about_id;
    }

    /**
     * @param mixed $about_id
     * @return About|mixed
     */
    public function setAboutId(About $about_id = null)
    {
        $this->about_id = $about_id;

        return $this;
    }
}
