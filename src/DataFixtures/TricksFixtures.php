<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TricksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $trick = new Tricks();
            $trick->setName("Nom de la figure $i")
                ->setDescription("<p>Description de la figure $i</p>")
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($trick);
        }

        $manager->flush();
    }
}
