<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Adress", cascade={"persist"})
     */
    private $adress;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MusicianCategory", cascade={"persist"}, fetch="EAGER")
     * @Assert\NotBlank()
     */
    private $musician;


    function __toString()
    {
        return $this->roles;
    }

    /**
     * Set adress
     *
     * @param \AppBundle\Entity\Adress $adress
     *
     * @return User
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
     * Add musician
     *
     * @param \AppBundle\Entity\MusicianCategory $musician
     *
     * @return User
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
}
