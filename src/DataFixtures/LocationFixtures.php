<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $randomNameSet = array(
            "Paris",
            "London",
            "Stockholm",
            "Berlin",
            "Warsaw",
            "Madrid",
            "Vienna",
            "Oslo",
            "Rome"
        );

        $this->createMany(Location::class, 10, function(Location $location, array $randomNames) {
            $location->setName($randomNames[array_rand($randomNames)])
                ->setRackId(rand(1,100))
                ->setPosition(rand(1,1000));
        }, $randomNameSet);

        $manager->flush();
    }
}
