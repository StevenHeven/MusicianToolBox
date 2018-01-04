<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 03/01/2018
 * Time: 15:10
 */

namespace AdminBundle\Controller;


use AdminBundle\Form\OfferAdminType;
use AppBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/offers")
 *
 * Class OfferAdminController
 * @package AdminBundle\Controller
 */
class OfferAdminController extends Controller
{

    /**
     * @Route("/", name="offer.index")
     */
    //Methode qui liste toutes les petites annonces
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(Offer::class);
        $offers= $repository->findAllWithComponents();

        return $this->render('@Admin/OfferAdmin/offerAdmin.html.twig', ["offers" => $offers]);

    }

    /**
     * @Route("/edit/{id}", name="editOffer")
     */
    //methode qui modifie une petite annonce
    public function editAction($id, Request $request){

        $offer= $this->getDoctrine()->getRepository(Offer::class)->find($id);

        $form1= $this->createForm(OfferAdminType::class, $offer);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute("offer.index");
        }

        return $this->render('@Admin/OfferAdmin/editOfferAdmin.html.twig', ["form" => $form1->createView()]);

    }

    /**
     * @Route("/delete/{id}", name="deleteOffer")
     * @param Offer $offer
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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


        return $this->redirectToRoute("offer.index");
    }
}