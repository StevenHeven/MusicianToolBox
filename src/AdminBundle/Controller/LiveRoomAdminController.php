<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 03/01/2018
 * Time: 12:00
 */

namespace AdminBundle\Controller;


use AppBundle\Entity\LiveRoom;
use AppBundle\Form\LiveRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/liveroom")
 *
 * Class liveroomController
 * @package AdminBundle\Controller
 */
class LiveRoomAdminController extends Controller
{

    /**
     * @Route("/", name="liveroom.index")
     */
    //Methode qui liste toutes les salles de concert
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(LiveRoom::class);
        $liverooms= $repository->findAll();

        return $this->render('@Admin/LiveRoomAdmin/liveRoomAdminIndex.html.twig', ["liverooms" => $liverooms]);

    }

    /**
     * @Route("/edit/{id}", name="editLiveroom")
     */
    //methode qui modifie une salle de concert
    public function editAction($id, Request $request){

        $liveroom= $this->getDoctrine()->getRepository(LiveRoom::class)->find($id);


        $form1= $this->createForm(LiveRoomType::class, $liveroom);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($liveroom);
            $em->flush();

            return $this->redirectToRoute("liveroom.index");
        }

        return $this->render('@Admin/LiveRoomAdmin/editLiveroomAdmin.html.twig', ["form" => $form1->createView()]);


    }

    /**
     * @Route("/delete/{id}", name="deleteLiveRoom")
     * @param LiveRoom $liveroom
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime une catégorie
    public function deleteAction(LiveRoom $liveroom, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($liveroom);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("La salle de concert #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("liveroom.index");
    }
}