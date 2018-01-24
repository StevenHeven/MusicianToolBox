<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 06/10/2017
 * Time: 11:52
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Image;
use AppBundle\Entity\Offer;
use AppBundle\Form\OfferType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/offers")
 */
class OfferController extends Controller
{
    /**
     * @Route("/index", name="indexOffer")
     */
    public function indexOfferAction(){
        $repository= $this->getDoctrine()->getRepository(Offer::class);
        $offers= $repository->findAllWithComponents();                                  //SELECT * from Offer


        return $this->render('@App/Offer/indexOffer.html.twig', ['offers' => $offers]);
    }

    /**
     * @Route("/addOffer", name="addOffer")
     */
    public function addOfferAction(Request $request){
        $offer= new Offer();

        $offer->setUser($this->getUser());

        $offer->addImage(new Image($offer));
        $offer->addImage(new Image($offer));
        $offer->addImage(new Image($offer));

        $form= $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em= $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();



            return $this->redirectToRoute("indexOffer");
        }
        return $this->render('@App/Offer\addOffer.html.twig', ["form"=>$form->createView()]);
    }

    /**
     * @Route("/offer={id}", name="offer")
     */
    public function offerAction($id){

        $offer_images= $this->getDoctrine()
                ->getRepository(Offer::class)
            ->findWithPictures($id);


        return $this->render('@App/Offer/oneOffer.html.twig', ['offer_images' => $offer_images]);
    }

    /**
     * @Route("/edit/{id}", name="editOffer")
     */
    //methode qui modifie une petite annonce
    public function editAction($id, Request $request){

        $offer= $this->getDoctrine()->getRepository(Offer::class)->findWithPictures($id);;

        $form1= $this->createForm(OfferType::class, $offer);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute("indexOffer");
        }

        return $this->render('@App/Offer/editOffer.html.twig', ["form" => $form1->createView()]);
    }

    /**
     * @Route("/delete/{id}", name="deleteOffer")
     */
    //methode qui supprime une petite annonce
    public function deleteAction(Offer $offer, $id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("L'annonce #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("indexOffer");
    }

}