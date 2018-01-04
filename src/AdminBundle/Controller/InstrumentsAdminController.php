<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 04/01/2018
 * Time: 10:56
 */

namespace AdminBundle\Controller;


use AdminBundle\Form\InstrumentsType;
use AppBundle\Entity\Instruments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/instruments")
 *
 * Class InstrumentAdminController
 * @package AdminBundle\Controller
 */
class InstrumentsAdminController extends Controller
{

    /**
     * @Route("/", name="instrument.index")
     */
    //Methode qui liste les instruments
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(Instruments::class);
        $instruments= $repository->findAll();

        return $this->render('@Admin/InstrumentAdmin/instrumentIndex.html.twig', ["instruments" => $instruments]);

    }

    /**
     * @Route("/add", name="addInstrument")
     */
    //methode qui ajoute un instrument
    public function addAction(Request $request){
        $instrument= new Instruments();

        $form1= $this->createForm(InstrumentsType::class, $instrument);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $em=$this->getDoctrine()->getManager();

            //persist
            $em->persist($form1->getData());
            //flush
            $em->flush();

            return $this->redirectToRoute("instrument.index");
        }

        return $this->render('@Admin/InstrumentAdmin\addInstrument.html.twig',
            ["form" => $form1->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="editInstrument")
     */
    //methode qui modifie un instrument
    public function editAction($id, Request $request){

        $instrument= $this->getDoctrine()->getRepository(Instruments::class)->find($id);


        $form1= $this->createForm(InstrumentsType::class, $instrument);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($instrument);
            $em->flush();

            return $this->redirectToRoute("instrument.index");
        }

        return $this->render('@Admin/InstrumentAdmin\editInstrument.html.twig', ["form" => $form1->createView()]);


    }

    /**
     * @Route("/delete/{id}", name="deleteInstrument")
     * @param Instruments $instrument
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime un instrument
    public function deleteAction(Instruments $instrument, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($instrument);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("L'instrument #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("instrument.index");
    }
}