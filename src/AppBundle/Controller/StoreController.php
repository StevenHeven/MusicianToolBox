<?php
/**
 * Created by PhpStorm.
 * User: Steven Dev17
 * Date: 06/10/2017
 * Time: 10:01
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Store;
use AppBundle\Form\StoreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/store")
 */
class StoreController extends Controller
{
    /**
     * @Route("/index", name="indexStore")
     */
    public function indexStoreAction(){
        $repository= $this->getDoctrine()->getRepository(Store::class);
        $stores= $repository->findAll();                                  //SELECT * from liveroom

        return $this->render('@App/Store/indexStore.html.twig', ['stores' => $stores]);
    }

    /**
     * @Route("/addStore", name="addStore")
     */
    public function addStoreAction(Request $request){
        $store= new Store();
        $store->setUser($this->getUser());

        $form= $this->createForm(StoreType::class, $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute("indexStore");
        }
        return $this->render('@App/Store\addStore.html.twig', ["form"=>$form->createView()]);
    }


}