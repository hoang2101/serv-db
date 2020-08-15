<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class AppFixtures extends Fixture
{
    /** @var ObjectManager */
    private $manager;
    abstract protected function loadData(ObjectManager $manager);

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadData($manager);
    }

    protected function createMany(string $className, int $count, callable $factory, ...$randomData)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, ...$randomData);
            $this->manager->persist($entity);
        }
        $this->manager->flush();
    }
}
