<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 04/01/2018
 * Time: 10:03
 */

namespace AdminBundle\Controller;


use AppBundle\Entity\Concert;
use AppBundle\Form\ConcertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/concerts")
 *
 * Class ConcertAdminController
 * @package AdminBundle\Controller
 */
class ConcertAdminController extends Controller
{

    /**
     * @Route("/", name="concert.index")
     */
    //Methode qui liste tous les concerts
    public function indexAction()
    {
        try{
            $repository= $this->getDoctrine()->getRepository(Concert::class);
            $concerts= $repository->findAll();

            return $this->render('@Admin/ConcertAdmin/concertAdmin.html.twig', ["concerts" => $concerts]);
        }
        catch (Exception $e){
            throw $this->createNotFoundException("Il n'y a pas de concert enregistrés.");
        }

    }

    /**
     * @Route("/edit/{id}", name="editConcert")
     */
    //methode qui modifie un concert
    public function editAction($id, Request $request){

        $concert= $this->getDoctrine()->getRepository(Concert::class)->find($id);

        $form1= $this->createForm(ConcertType::class, $concert);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concert);
            $em->flush();

            return $this->redirectToRoute("concert.index");
        }

        return $this->render('@Admin/ConcertAdmin/editConcertAdmin.html.twig', ["form" => $form1->createView()]);

    }

    /**
     * @Route("/delete/{id}", name="deleteConcert")
     * @param Concert $concert
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime une petite annonce
    public function deleteAction(Concert $concert, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($concert);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("Le concert #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("concert.index");
    }
}