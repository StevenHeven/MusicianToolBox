<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 11/12/2017
 * Time: 20:04
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Concert;
use AppBundle\Entity\Image;
use AppBundle\Form\ConcertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConcertController
 * @Route ("/concert")
 */

class ConcertController extends Controller
{

    /**
     * @Route("/index", name="indexConcert")
     */
    public function indexConcertAction(){
        $repository= $this->getDoctrine()->getRepository(Concert::class);
        $concerts= $repository->findAll();                                  //SELECT * from concert

        return $this->render('@App/Concert/indexConcert.html.twig', ['concerts' => $concerts]);
    }

    /**
     * @Route("/addConcert", name="addConcert")
     */
    public function addConcertAction(Request $request){
        $concert = new Concert();

        $form= $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($concert);
            $em->flush();

            return $this->redirectToRoute("indexConcert");
        }
        return $this->render('@App/Concert\addConcert.html.twig', ["form"=>$form->createView()]);
    }
}