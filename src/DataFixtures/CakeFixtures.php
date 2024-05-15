<?php

namespace App\DataFixtures;

use App\Entity\Cake;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CakeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cake = new Cake();
        $cake->setName('Pirate Cake');
        $cake->setImage('pirate-cake.jpg');
        $cake->setActive(true);
        $cake->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = new Cake();
        $cake->setName('Owl Cake');
        $cake->setImage('owl-cake.jpg');
        $cake->setActive(true);
        $cake->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $manager->flush();
    }
}
