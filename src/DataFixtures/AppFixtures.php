<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    

        $a1 = new Aliment();
        $a1 ->setNom("Carote")
            ->setCalorie(36)
            ->setPrix(1.80)
            ->setImage("carotte.png")
            ->setProteine(0.77)
            ->setGlucide(6.45)
            ->setLipide(0.26);

        $a1->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2 ->setNom("Patate")
            ->setCalorie(80)
            ->setPrix(1.50)
            ->setImage("patate.png")
            ->setProteine(1.80)
            ->setGlucide(16.45)
            ->setLipide(0.34);

        
        $a2->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a2);
        

        $a3 = new Aliment();
        $a3 ->setNom("Tomate")
            ->setCalorie(18)
            ->setPrix(2.30)
            ->setImage("tomate.png")
            ->setProteine(0.86)
            ->setGlucide(2.26)
            ->setLipide(0.24);

        $a3->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a3);

     

        $a4 = new Aliment();
        $a4 ->setNom("Pomme")
            ->setCalorie(52)
            ->setPrix(2.35)
            ->setImage("pomme.png")
            ->setProteine(0.25)
            ->setGlucide(11.45)
            ->setLipide(0.21);

        $a4->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a4);

        $manager->flush();

        
    }
}
