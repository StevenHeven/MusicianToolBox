<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="LiveRoom")
 */
class LiveRoom
{

    use Id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Concert", mappedBy="liveroom")
     */
    private $concerts;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", cascade={"persist"})
     */
    private $user;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return LiveRoom
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return LiveRoom
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return LiveRoom
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return LiveRoom
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return LiveRoom
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return LiveRoom
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return LiveRoom
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return LiveRoom
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
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
     * Add concert
     *
     * @param \AppBundle\Entity\Concert $concert
     *
     * @return LiveRoom
     */
    public function addConcert(\AppBundle\Entity\Concert $concert)
    {
        $this->concerts[] = $concert;

        return $this;
    }

    /**
     * Remove concert
     *
     * @param \AppBundle\Entity\Concert $concert
     */
    public function removeConcert(\AppBundle\Entity\Concert $concert)
    {
        $this->concerts->removeElement($concert);
    }

    /**
     * Get concerts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConcerts()
    {
        return $this->concerts;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return LiveRoom
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
