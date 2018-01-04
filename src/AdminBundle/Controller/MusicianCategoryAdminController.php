<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 04/01/2018
 * Time: 11:38
 */

namespace AdminBundle\Controller;

use AdminBundle\Form\MusicianCategoryType;
use AppBundle\Entity\MusicianCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/musicianCategory")
 *
 * Class MusicianCategoryAdminController
 * @package AdminBundle\Controller
 */
class MusicianCategoryAdminController extends Controller
{

    /**
     * @Route("/", name="musicianCategory.index")
     */
    //Methode qui liste les styles de musicien
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(MusicianCategory::class);
        $musicianCategories= $repository->findAll();

        return $this->render('@Admin/MusicianCategoryAdmin/musicianCategoryIndex.html.twig', ["musicianCategories" => $musicianCategories]);

    }

    /**
     * @Route("/add", name="addMusicianCategory")
     */
    //methode qui ajoute un style de musicien
    public function addAction(Request $request){
        $musicianCategory= new MusicianCategory();

        $form1= $this->createForm(MusicianCategoryType::class, $musicianCategory);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $em=$this->getDoctrine()->getManager();

            //persist
            $em->persist($form1->getData());
            //flush
            $em->flush();

            return $this->redirectToRoute("musicianCategory.index");
        }

        return $this->render('@Admin/MusicianCategoryAdmin\addMusicianCategory.html.twig',
            ["form" => $form1->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="editMusicianCategory")
     */
    //methode qui modifie un style de musicien
    public function editAction($id, Request $request){

        $musicianCategory= $this->getDoctrine()->getRepository(MusicianCategory::class)->find($id);


        $form1= $this->createForm(MusicianCategoryType::class, $musicianCategory);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($musicianCategory);
            $em->flush();

            return $this->redirectToRoute("musicianCategory.index");
        }

        return $this->render('@Admin/MusicianCategoryAdmin/editMusicianCategory.html.twig', ["form" => $form1->createView()]);


    }

    /**
     * @Route("/delete/{id}", name="deleteMusicianCategory")
     * @param MusicianCategory $musicianCategory
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime un style de musicien
    public function deleteAction(MusicianCategory $musicianCategory, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($musicianCategory);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("Le style de musicien #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("musicianCategory.index");
    }
}