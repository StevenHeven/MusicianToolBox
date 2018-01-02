<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 11/12/2017
 * Time: 19:37
 */

namespace AppBundle\Entity;


use AppBundle\Traits\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Concert")
 */
class Concert
{

    use Id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LiveRoom", mappedBy="concerts", cascade={"persist"})
     */
    private $liveroom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $facebook;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MusicCategory", cascade={"persist"}, fetch="EAGER")
     */
    private $style;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="concert", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="RESTRICT")
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->style = new ArrayCollection();
        $this->liveroom = new ArrayCollection();
        $this->image= new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Concert
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
     * @return Concert
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
     * @return Concert
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add liveroom
     *
     * @param \AppBundle\Entity\LiveRoom $liveroom
     *
     * @return Concert
     */
    public function addLiveroom(\AppBundle\Entity\LiveRoom $liveroom)
    {
        $this->liveroom[] = $liveroom;

        return $this;
    }

    /**
     * Remove liveroom
     *
     * @param \AppBundle\Entity\LiveRoom $liveroom
     */
    public function removeLiveroom(\AppBundle\Entity\LiveRoom $liveroom)
    {
        $this->liveroom->removeElement($liveroom);
    }

    /**
     * Get liveroom
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiveroom()
    {
        return $this->liveroom;
    }

    /**
     * Add style
     *
     * @param \AppBundle\Entity\MusicCategory $style
     *
     * @return Concert
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Concert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Concert
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

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Concert
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
     * @return Concert
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
}
