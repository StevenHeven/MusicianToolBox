<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 03/01/2018
 * Time: 14:06
 */

namespace AdminBundle\Controller;


use AppBundle\Entity\Store;
use AppBundle\Form\StoreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/stores")
 *
 * Class StoreAdminController
 * @package AdminBundle\Controller
 */

class StoreAdminController extends Controller
{

    /**
     * @Route("/", name="store.index")
     */
    //Methode qui liste toutes les magasins
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(Store::class);
        $stores= $repository->findAll();

        return $this->render('@Admin/StoreAdmin/storeAdmin.html.twig', ["stores" => $stores]);

    }

    /**
     * @Route("/edit/{id}", name="editStore")
     */
    //methode qui modifie un magasin
    public function editAction($id, Request $request){

        $store= $this->getDoctrine()->getRepository(Store::class)->find($id);


        $form1= $this->createForm(StoreType::class, $store);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($store);
            $em->flush();

            return $this->redirectToRoute("store.index");
        }

        return $this->render('@Admin/StoreAdmin/editStoreAdmin.html.twig', ["form" => $form1->createView()]);


    }

    /**
     * @Route("/delete/{id}", name="deleteStore")
     * @param Store $store
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime une catégorie
    public function deleteAction(Store $store, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($store);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("Le magasin #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("store.index");
    }
}