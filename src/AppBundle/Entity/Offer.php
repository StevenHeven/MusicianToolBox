<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 06/10/2017
 * Time: 11:00
 */

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 * @ORM\Table(name="Offer")
 */
class Offer
{
    use Id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $delivery;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adress", cascade={"persist"})
     */
    private $adress;
    /**
     * @ORM\Column(type="string"), nullable=true
     */
    private $checkPro;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OfferCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MusicCategory", cascade={"persist"}, fetch="EAGER")
     */
    private $style;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MusicianCategory", cascade={"persist"}, fetch="EAGER")
     */
    private $musician;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Instruments", cascade={"persist"}, fetch="EAGER")
     */
    private $instrument;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="offer", cascade={"remove"})
     */
    private $image;

    public function __construct()
    {
        $this->style= new ArrayCollection();
        $this->musician= new ArrayCollection();
        $this->instrument= new ArrayCollection();
        $this->image= new ArrayCollection();
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Offer
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
     * Set description
     *
     * @param string $description
     *
     * @return Offer
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
     * Set price
     *
     * @param integer $price
     *
     * @return Offer
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set delivery
     *
     * @param string $delivery
     *
     * @return Offer
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return string
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set checkPro
     *
     * @param string $checkPro
     *
     * @return Offer
     */
    public function setCheckPro($checkPro)
    {
        $this->checkPro = $checkPro;

        return $this;
    }

    /**
     * Get checkPro
     *
     * @return string
     */
    public function getCheckPro()
    {
        return $this->checkPro;
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
     * Set adress
     *
     * @param \AppBundle\Entity\Adress $adress
     *
     * @return Offer
     */
    public function setAdress(\AppBundle\Entity\Adress $adress = null)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return \AppBundle\Entity\Adress
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\OfferCategory $category
     *
     * @return Offer
     */
    public function setCategory(\AppBundle\Entity\OfferCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\OfferCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add style
     *
     * @param \AppBundle\Entity\MusicCategory $style
     *
     * @return Offer
     */
    public function addStyle(\AppBundle\Entity\MusicCategory $style)
    {
        $this->style[] = $style;

        return $this;
    }

    /**
     * Remove style
     *
     * @param \AppBundle\Entity\MusicCategory $style
     */
    public function removeStyle(\AppBundle\Entity\MusicCategory $style)
    {
        $this->style->removeElement($style);
    }

    /**
     * Get style
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Add musician
     *
     * @param \AppBundle\Entity\MusicianCategory $musician
     *
     * @return Offer
     */
    public function addMusician(\AppBundle\Entity\MusicianCategory $musician)
    {
        $this->musician[] = $musician;

        return $this;
    }

    /**
     * Remove musician
     *
     * @param \AppBundle\Entity\MusicianCategory $musician
     */
    public function removeMusician(\AppBundle\Entity\MusicianCategory $musician)
    {
        $this->musician->removeElement($musician);
    }

    /**
     * Get musician
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusician()
    {
        return $this->musician;
    }

    /**
     * Add instrument
     *
     * @param \AppBundle\Entity\Instruments $instrument
     *
     * @return Offer
     */
    public function addInstrument(\AppBundle\Entity\Instruments $instrument)
    {
        $this->instrument[] = $instrument;

        return $this;
    }

    /**
     * Remove instrument
     *
     * @param \AppBundle\Entity\Instruments $instrument
     */
    public function removeInstrument(\AppBundle\Entity\Instruments $instrument)
    {
        $this->instrument->removeElement($instrument);
    }

    /**
     * Get instrument
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstrument()
    {
        return $this->instrument;
    }


    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Offer
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return ArrayCollection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Offer
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }
}
