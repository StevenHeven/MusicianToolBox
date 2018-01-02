<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 04/10/2017
 * Time: 09:47
 */


namespace AppBundle\Traits;


use Doctrine\ORM\Mapping as ORM;

trait Id
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
}