<?php

namespace App\DataFixtures;

use App\Entity\Cake;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CakeFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $cake = new Cake();
        $cake->setName('Pirate Cake');
        $cake->setImage(strtolower($this->slugger->slug('Pirate Cake')) . '.jpg');
        $cake->setActive(true);
        $cake->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = new Cake();
        $cake->setName('Owl Cake');
        $cake->setImage(strtolower($this->slugger->slug('Owl Cake')) . '.jpg');
        $cake->setActive(true);
        $cake->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $manager->flush();
    }
}
