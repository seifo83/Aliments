<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Util\AutoloaderUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $em -> persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute("aliments");
        }


        return $this->render('admin_secu/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }



    /**
     * @Route("/login", name="connexion")
     */
    public function login(AuthenticationUtils $util)
    {

        return $this->render('admin_secu/login.html.twig', [
            "lastUsername" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
            
        ]);
    }


    /**
     * @Route("/logout", name="deconnexion")
     */
    public function logout()
    {
        

        return $this->redirectToRoute("aliments");
    }
}
