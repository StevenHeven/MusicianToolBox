<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 09/10/2017
 * Time: 12:25
 */

namespace AppBundle\Entity;

use AppBundle\Traits\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="musicCategory")
*/
class MusicCategory
{
    use Id;

    /**
     * @ORM\Column(type="string")
     */
    private $label;


    function __toString()
    {
        return $this->label;
    }
    /**
     * Set label
     *
     * @param string $label
     *
     * @return MusicCategory
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