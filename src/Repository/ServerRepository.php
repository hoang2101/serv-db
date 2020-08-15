<?php

namespace App\Repository;

use App\Entity\Server;
use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Server|null find($id, $lockMode = null, $lockVersion = null)
 * @method Server|null findOneBy(array $criteria, array $orderBy = null)
 * @method Server[]    findAll()
 * @method Server[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Server::class);
    }


    public function getAllServer()
    {
        return $this->createQueryBuilder('s')
            ->leftJoin("s.locationId", "l")
            ->leftJoin("s.ownerId", "o")
            ->addSelect("l", "o")
            ->getQuery()
            ->getArrayResult();
    }

    public function getOneServer(int $id)
    {
        return $this->createQueryBuilder('s')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->leftJoin("s.locationId", "l")
            ->leftJoin("s.ownerId", "o")
            ->addSelect("l", "o")
            ->getQuery()
            ->getArrayResult();
    }
}
