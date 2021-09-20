<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TricksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $trick = new Trick();
            $trick->setName("Nom de la figure $i")
                ->setDescription("<p>Description de la figure $i</p>")
                ->setCreatedAt(new \DateTimeImmutable())
                ->generateSlug();


            $manager->persist($trick);
        }

        $manager->flush();
    }
}
