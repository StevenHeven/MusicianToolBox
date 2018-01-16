<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 16/01/2018
 * Time: 14:25
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/edit/{id}", name="editUser")
     */
    //methode qui modifie une petite annonce
    public function editAction($id, Request $request){

        $offer= $this->getDoctrine()->getRepository(User::class)->find($id);;

        $form1= $this->createForm(UserType::class, $offer);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute("user.info");
        }

        return $this->render('@App/User/editUser.html.twig', ["form" => $form1->createView()]);

    }

    /**
     * @Route("/user={id}", name="user.info")
     */
    public function userInfoAction($id){

        $user = $this->getUser();

        return $this->render('@App/User/userInfo.html.twig', ['users' => $user]);
    }

}