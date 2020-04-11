<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function index(AlimentRepository $AR)
    {
        $aliments = $AR->findAll();
        return $this->render('admin/admin.html.twig', [
            'aliments' =>  $aliments,
        ]);
    }


    /**
     * @Route("/admin/alimment/add", name="add_aliment_admin")
     * @Route("/admin/aliment/{id}", name="modification_aliment_admin", methods="GET|POST")
     */
    public function modificationEtajouter(Aliment $aliment = null , Request $request, EntityManagerInterface $em)
    {
        if (!$aliment) {
           $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class, $aliment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modf = $aliment->getId() !== null;
            $em->persist($aliment);
            $em->flush();
            $this->addFlash("success",  $modf ? "la modification a été effecutée" :  "L ajoute a été effectuée");
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/ModifEtAdd.html.twig', [
            'aliment' =>  $aliment,
            "form" => $form->createView(),
            "isModification" => $aliment->getId() !== null,
        ]);
    }

     /**
     * @Route("/admin/aliment/{id}", name="delate_admin", methods="delete")
     */
    public function delate(Aliment $aliment, Request $request, EntityManagerInterface $em )
    {
        //dd($aliment);

       if($this->isCsrfTokenValid("SUP". $aliment->getId(),$request->get('_token'))){
            $em->remove($aliment);
            $em->flush();
            $this->addFlash("success", "la suppression a été effecutée");
            return $this->redirectToRoute("admin");
        }
        

        
    }



}
