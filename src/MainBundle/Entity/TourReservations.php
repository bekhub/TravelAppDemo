<?php

namespace MainBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TourReservations
 *
 * @ORM\Table(name="tour_reservations")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TourReservationsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TourReservations
{
    public function __construct()
    {
        $this->setCreated(new DateTime());
        $this->setUpdated(new DateTime());
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('fullName', new NotBlank(array(
            'message' => 'You must enter your name'
        )));
        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'Your email is not correct'
        )));
        $metadata->addPropertyConstraint('phone', new NotBlank(array(
            'message' => 'You must enter a comment'
        )));
//        $metadata->addPropertyConstraint('bookDate', new NotBlank(array(
//            'message' => 'You must enter a date book'
//        )));
        $metadata->addPropertyConstraint('adults', new Assert\Length(array(
            'min'        => 1,
            'max'        => 20,
            'minMessage' => 'Количетсво взрослых должно быть не меньше {{ limit }}',
            'maxMessage' => 'Количетсво взрослых должно быть не больше {{ limit }}',
        )));
        $metadata->addPropertyConstraint('kids', new Assert\Length(array(
            'min'        => 0,
            'max'        => 20,
            'minMessage' => 'Количетсво детей должно быть не меньше {{ limit }}',
            'maxMessage' => 'Количетсво детей должно быть не больше {{ limit }}',
        )));
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
     * @ORM\Column(name="full_name", type="string")
     */
    private $fullName;

    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @ORM\Column(name="phone", type="string")
     * @Assert\Regex(
     *     pattern     = "/^[0-9]+$/i",
     *     htmlPattern = "^[0-9]+$"
     * )
     */
    private $phone;

//    /**
//     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TourDates", inversedBy="id")
//     */
//    private $bookDate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $bookDate;

    /**
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults = 1;

    /**
     * @ORM\Column(name="kids", type="integer")
     */
    private $kids = 0;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Tours", inversedBy="reservations")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     */
    private $tour_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;


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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getBookDate()
    {
        return $this->bookDate;
    }

    /**
     * @param mixed $bookDate
     * @return TourReservations
     */
    public function setBookDate($bookDate)
    {
        $this->bookDate = $bookDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * @param mixed $adults
     */
    public function setAdults($adults)
    {
        $this->adults = $adults;
    }

    /**
     * @return mixed
     */
    public function getKids()
    {
        return $this->kids;
    }

    /**
     * @param mixed $kids
     */
    public function setKids($kids)
    {
        $this->kids = $kids;
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
     * @return TourReservations
     */
    public function setTourId(Tours $tour_id = null)
    {
        $this->tour_id = $tour_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
}
