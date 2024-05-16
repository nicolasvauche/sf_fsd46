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
        $cake = (new Cake())
            ->setName('Pirate Cake')
            ->setImage(strtolower($this->slugger->slug('Pirate Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = (new Cake())
            ->setName('Owl Cake')
            ->setImage(strtolower($this->slugger->slug('Owl Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = (new Cake())
            ->setName('Bunny Cake')
            ->setImage(strtolower($this->slugger->slug('Bunny Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = (new Cake())
            ->setName('Butterfly Cake')
            ->setImage(strtolower($this->slugger->slug('Butterfly Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = (new Cake())
            ->setName('Ladybird Cake')
            ->setImage(strtolower($this->slugger->slug('Ladybird Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $cake = (new Cake())
            ->setName('Poison Cake')
            ->setImage(strtolower($this->slugger->slug('Poison Cake')) . '.jpg')
            ->setActive(true)
            ->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($cake);

        $manager->flush();
    }
}
