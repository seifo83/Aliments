<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliments")
     */
    public function index(AlimentRepository $AR)
    {
        $aliments = $AR->findAll();
        //dd($aliments);

        return $this->render('aliment/index.html.twig', [
            'aliments' =>  $aliments ,
            'iscalorie' => false,
            'isgluside' => false
        ]);
    }


    /**
     * @Route("/aliments/calorie/{calorie}", name="alimentsParCalorie")
     */
    public function alimentsCalorie(AlimentRepository $AR, $calorie)
    {

        //dd($calorie);

        $aliments = $AR->getAlimentParPropriete('calorie', '<', $calorie);

        return $this->render('aliment/index.html.twig', [
            'aliments' =>  $aliments ,
            'iscalorie' => true,
            'isgluside' => false
        ]);
    }


    /**
     * @Route("/aliments/glucide/{glucide}", name="alimentsParGlucide")
     */
    public function alimentsMoinsGlucide(AlimentRepository $AR, $glucide)
    {
        //dd($glucide);

        $aliments = $AR->getAlimentParPropriete('glucide', '<', $glucide);

        return $this->render('aliment/index.html.twig', [
            'aliments' =>  $aliments ,
            'iscalorie' => false,
            'isgluside' => true
        ]);
    }




}
