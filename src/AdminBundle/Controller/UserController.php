<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 19/01/2018
 * Time: 09:22
 */

namespace AdminBundle\Controller;


use AdminBundle\Form\UsersAdminType;
use AppBundle\Entity\Adress;
use AppBundle\Entity\User;
use AppBundle\Form\AdressType;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/users")
 *
 * Class UsersAdminController
 * @package AdminBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="users.index")
     */
    //Methode qui liste tous les utilisateurs
    public function indexAction()
    {
        try{
            $repository= $this->getDoctrine()->getRepository(User::class);
            $users= $repository->findAll();

            return $this->render('@Admin/UsersAdmin/usersAdminIndex.html.twig', ["users" => $users]);
        }
        catch (Exception $e){
            throw $this->createNotFoundException("Il n'y a pas d'utilisateurs enregistrés.");
        }

    }

    /**
     * @Route("/edit/{id}", name="editUsers")
     */
    //methode qui modifie un utilisateur
    public function editAction($id, Request $request){

        $concert= $this->getDoctrine()->getRepository(User::class)->find($id);

        $form1= $this->createForm(UsersAdminType::class, $concert);
        $form1->handleRequest($request);

        if ($form1->isValid())  {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concert);
            $em->flush();

            return $this->redirectToRoute("users.index");
        }

        return $this->render('@Admin/UsersAdmin/editUsersAdmin.html.twig', ["form" => $form1->createView()]);

    }

    /**
     * @Route("/delete/{id}", name="deleteUsers")
     * @param User $user
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime un utilisateur
    public function deleteAction(User $user, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("L'utilisateur #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("users.index");
    }
}