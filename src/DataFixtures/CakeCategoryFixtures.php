<?php

namespace App\DataFixtures;

use App\Entity\CakeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CakeCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cakeCategory = (new CakeCategory())
            ->setName('Gâteaux à la crème')
            ->setActive(true);
        $manager->persist($cakeCategory);

        $cakeCategory = (new CakeCategory())
            ->setName('Gâteaux au chocolat')
            ->setActive(true);
        $manager->persist($cakeCategory);

        $cakeCategory = (new CakeCategory())
            ->setName('Gâteaux divers')
            ->setActive(true);
        $manager->persist($cakeCategory);

        $manager->flush();
    }
}
