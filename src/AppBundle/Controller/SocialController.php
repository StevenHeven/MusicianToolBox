<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 02/01/2018
 * Time: 15:32
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class SocialController
 * @Route ("/social")
 */

class SocialController extends Controller
{
    /**
     * @Route("/home", name="indexSocial")
     */
    public function indexSocialAction(){

        return $this->render('@App/Social/indexSocial.html.twig');
    }
}