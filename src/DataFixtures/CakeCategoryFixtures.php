<?php

namespace App\DataFixtures;

use App\Entity\CakeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CakeCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $cakeCategory = (new CakeCategory())
            ->setName('Creme Cakes')
            ->setActive(true);
        $manager->persist($cakeCategory);
        $this->addReference('cake-category-creme', $cakeCategory);

        $cakeCategory = (new CakeCategory())
            ->setName('Chocolate Cakes')
            ->setActive(true);
        $manager->persist($cakeCategory);
        $this->addReference('cake-category-chocolate', $cakeCategory);

        $cakeCategory = (new CakeCategory())
            ->setName('Misc Cakes')
            ->setActive(true);
        $manager->persist($cakeCategory);
        $this->addReference('cake-category-misc', $cakeCategory);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
