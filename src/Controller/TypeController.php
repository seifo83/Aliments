<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function type(TypeRepository $TR)
    {
        $types = $TR-> findAll();

        //dd($types);


        return $this->render('type/index.html.twig', [
           "types" => $types
        ]);
    }


    /**
     * @Route("/admin/listetype", name="typeliste_admin")
     */
    public function listeadmin(TypeRepository $TR)
    {
        $types = $TR-> findAll();

        //dd($types);


        return $this->render('type/type.html.twig', [
           "types" => $types
        ]);
    }


    /**
     * @Route("/admin/type/add", name="addType")
     * @Route("/admin/type/{id}", name="modifType", methods="GET|POST")
     */
    public function modifETajoute(Type $type = null, Request $request, EntityManagerInterface $em )
    {
        if (!$type) {
            $type = new Type();
        }


        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $modf = $type->getId() !== null;

            $em->persist($type);
            $em->flush();
            $this->addFlash("success",  $modf ? "la modification a été effecutée" :  "L ajoute a été effectuée");
            return $this-> redirectToRoute('typeliste_admin');

        }

        return $this->render('type/ajoutETmodif.html.twig', [
           "types" => $type,
           "form"=> $form->createView()

        ]);
    }


    /**
     * @Route("/admin/type/{id}", name="delate_type", methods="delete")
     */
    public function delete(Type $type, EntityManagerInterface $em, Request $request)
    {
       if ($this->isCsrfTokenValid('SUP' .$type->getId(), $request->get('_token'))) {
          $em->remove($type);
          $em->flush();

          $this->addFlash('success', 'le type a été supprimé' );

          return $this->redirectToRoute('typeliste_admin');


       }


       
    }





}
