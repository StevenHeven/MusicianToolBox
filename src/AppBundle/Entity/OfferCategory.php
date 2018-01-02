<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 09/10/2017
 * Time: 09:54
 */

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="CategoryOffer")
 */
class OfferCategory{

    use Id;

    /**
     * @ORM\Column(type="string")
     */
    private $label;

    public function __construct()
    {
        $this->label = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return OfferCategory
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
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
}
