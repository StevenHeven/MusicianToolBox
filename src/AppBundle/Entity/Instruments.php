<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 09/10/2017
 * Time: 13:32
 */

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Instrument")
 */
class Instruments
{
    use Id;

    /**
     * @ORM\Column(type="string")
     */
    private $instrument;


    function __toString()
    {
        return $this->instrument;
    }

    /**
     * Set instrument
     *
     * @param string $instrument
     *
     * @return Instruments
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;

        return $this;
    }

    /**
     * Get instrument
     *
     * @return string
     */
    public function getInstrument()
    {
        return $this->instrument;
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
