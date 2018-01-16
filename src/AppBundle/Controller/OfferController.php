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
    public function offerAction($id, Request $request){

        $offer_images= $this->getDoctrine()
                ->getRepository(Offer::class)
            ->findWithPictures($id);


        return $this->render('@App/Offer/oneOffer.html.twig', ['offer_images' => $offer_images]);
    }

}