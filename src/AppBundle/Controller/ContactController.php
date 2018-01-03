<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 02/01/2018
 * Time: 16:24
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class ContactController extends Controller
{
    /**
     * @Route ("/contact", name="contact")
     */
    public function contactAction(){

        return $this->render('@App/contact.html.twig');
    }

}