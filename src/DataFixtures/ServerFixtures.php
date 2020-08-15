<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\Owner;
use App\Entity\Server;
use Doctrine\Persistence\ObjectManager;

class ServerFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $randomTypeSet = array(
            "Linux",
            "Windows",
        );

        $randomDesSet = array(
            "i7 RAM-32GB HDD 100GB",
            "i5 RAM-8GB HDD 50GB",
            "i3 RAM-16GB HDD 100GB",
            "i7 RAM-32GB HDD 500GB",
            "i3 RAM-16GB HDD 10GB",
        );

        $locationRepository = $manager->getRepository(Location::class);
        $locationSet = $locationRepository->findAll();

        $ownerRepository = $manager->getRepository(Owner::class);
        $ownerSet = $ownerRepository->findAll();

        $this->createMany(Server::class, 20, function(
            Server $server,
            array $randomTypes,
            array $randomDescriptions,
            array $randomLocations,
            array $randomOwners
        ) {
            $randomLocation = $randomLocations[array_rand($randomLocations)];
            $randomOwner = $randomOwners[array_rand($randomOwners)];
            $server->setName($randomLocation->getName()."-".$randomOwner->getName())
                ->setType($randomTypes[array_rand($randomTypes)])
                ->setDescription($randomDescriptions[array_rand($randomDescriptions)])
                ->setLocationId($randomLocation)
                ->setOwnerId($randomOwner);
        }, $randomTypeSet, $randomDesSet, $locationSet, $ownerSet);

        $manager->flush();
    }
}
