<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 04/10/2017
 * Time: 10:07
 */

namespace AppBundle\Controller;


use AppBundle\Entity\LiveRoom;
use AppBundle\Form\LiveRoomType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/liveroom")
 */
class LiveRoomController extends Controller
{
    /**
     * @Route("/index", name="indexLiveRoom")
     */
    public function indexRoomAction(){
        $repository= $this->getDoctrine()->getRepository(LiveRoom::class);
        $liveRooms= $repository->findAll();                                  //SELECT * from liveroom

        return $this->render('@App/LiveRoom/indexLiveRoom.html.twig', ['liverooms' => $liveRooms]);
    }

    /**
     * @Route("/addLiveRoom", name="addLiveRoom")
     */
    public function addRoomAction(Request $request){
        $room= new LiveRoom();

        $room->setUser($this->getUser());

        $form= $this->createForm(LiveRoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute("indexLiveRoom");
        }
        return $this->render('@App/LiveRoom\addLiveRoom.html.twig', ["form"=>$form->createView()]);
    }
}