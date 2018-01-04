<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 04/01/2018
 * Time: 11:21
 */

namespace AdminBundle\Controller;

use AdminBundle\Form\MusicCategoryType;
use AppBundle\Entity\MusicCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin/musicCategory")
 *
 * Class MusicCategoryAdminController
 * @package AdminBundle\Controller
 */
class MusicCategoryAdminController extends Controller
{

    /**
     * @Route("/", name="musicCategory.index")
     */
    //Methode qui liste les styles de musique
    public function indexAction()
    {
        $repository= $this->getDoctrine()->getRepository(MusicCategory::class);
        $musicCategories= $repository->findAll();

        return $this->render('@Admin/MusicCategoryAdmin/musicCategoryIndex.html.twig', ["musicCategories" => $musicCategories]);

    }

    /**
     * @Route("/add", name="addMusicCategory")
     */
    //methode qui ajoute un style de musique
    public function addAction(Request $request){
        $musicCategory= new MusicCategory();

        $form1= $this->createForm(MusicCategoryType::class, $musicCategory);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $em=$this->getDoctrine()->getManager();

            //persist
            $em->persist($form1->getData());
            //flush
            $em->flush();

            return $this->redirectToRoute("musicCategory.index");
        }

        return $this->render('@Admin/MusicCategoryAdmin\addMusicCategory.html.twig',
            ["form" => $form1->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="editMusicCategory")
     */
    //methode qui modifie un style de musique
    public function editAction($id, Request $request){

        $musicCategory= $this->getDoctrine()->getRepository(MusicCategory::class)->find($id);


        $form1= $this->createForm(MusicCategoryType::class, $musicCategory);
        $form1->handleRequest($request);

        if ($form1->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($musicCategory);
            $em->flush();

            return $this->redirectToRoute("musicCategory.index");
        }

        return $this->render('@Admin/MusicCategoryAdmin/editMusicCategory.html.twig', ["form" => $form1->createView()]);


    }

    /**
     * @Route("/delete/{id}", name="deleteMusicCategory")
     * @param MusicCategory $musicCategory
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //methode qui supprime un style de musique
    public function deleteAction(MusicCategory $musicCategory, $id)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($musicCategory);
            $em->flush();
        }

        catch (Exception $e){
            throw $this->createNotFoundException("Le style de musique #".$id." n'existe pas ou a été déjà supprimé");
        }


        return $this->redirectToRoute("musicCategory.index");
    }
}