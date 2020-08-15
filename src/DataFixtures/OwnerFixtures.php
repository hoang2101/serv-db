<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use Doctrine\Persistence\ObjectManager;

class OwnerFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $randomNameSet = array(
            "Maurice Reyes",
            "Noel Zavala",
            "Raquel Lang",
            "Aryanna Fry",
            "Sage Browning",
            "Alayna Crosby",
            "Orion Hamilton",
            "Spencer Guerra",
            "Reuben Lester"
        );

        $randomAddressSet = array(
            "874 Stillwater Drive Powhatan, VA 23139",
            "8229 Birch Hill Court Midlothian, VA 23112",
            "9754 N. Hartford Drive Calhoun, GA 30701",
        );

        $this->createMany(Owner::class, 10, function(Owner $owner, array $randomNames, array $randomAddresses) {
            $owner->setName($randomNames[array_rand($randomNames)])
                ->setAddress($randomAddresses[array_rand($randomAddresses)]);
        }, $randomNameSet, $randomAddressSet);

        $manager->flush();
    }
}
