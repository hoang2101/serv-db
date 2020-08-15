<?php
namespace App\Controller;

use App\Entity\Location;
use App\Entity\Owner;
use App\Entity\Server;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class ServerController extends AbstractController
{
    /**
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @Rest\Route("/api", methods={"GET"})
     */
    public function index(SerializerInterface $serializer) : Response
    {
        $connection = $this->getDoctrine()->getManager();
        $serverList = $connection->getRepository(Server::class)->getAllServer();

        $jsonContent = $serializer->serialize($serverList, 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param int $id
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @Rest\Route("/api/{id}", methods={"GET"})
     */
    public function getServer(int $id, SerializerInterface $serializer) : Response
    {
        $connection = $this->getDoctrine()->getManager();
        $currentServer = $connection->getRepository(Server::class)->getOneServer($id);

        $jsonContent = $serializer->serialize($currentServer, 'json');
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param int $id
     * @return Response
     * @Rest\Route("/api/{id}", methods={"DELETE"})
     */
    public function deleteServer(int $id)
    {
        $connection = $this->getDoctrine()->getManager();
        $currentServer = $connection->getRepository(Server::class)->find($id);
        if (empty($currentServer)) {
            return new Response("Server $id not exist", Response::HTTP_NOT_FOUND);
        }

        $connection->remove($currentServer);
        $connection->flush();

        return new Response("Deleted server $id", Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return Response
     * @Rest\Route("/api", methods={"POST"})
     */
    public function createServer(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['name']) || empty($data['type']) || empty($data['description'])) {
            return new Response("Invalid server fields", Response::HTTP_BAD_REQUEST);
        }

        $connection = $this->getDoctrine()->getManager();
        $selectedLocation = $connection->getRepository(Location::class)->find($data['location_id']);
        $selectedOwner = $connection->getRepository(Owner::class)->find($data['owner_id']);
        if (empty($selectedLocation) || empty($selectedOwner)) {
            return new Response("Invalid location or owner ID", Response::HTTP_NOT_FOUND);
        }

        $newServer = new Server();
        $newServer->setName($data['name'])
            ->setType($data['type'])
            ->setDescription($data['description'])
            ->setLocationId($selectedLocation)
            ->setOwnerId($selectedOwner);

        $connection->persist($newServer);
        $connection->flush();
        return new Response("Added server ". $newServer->getId(), Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     * @Rest\Route("/api/{id}", methods={"PUT"})
     */
    public function updateServer(int $id, Request $request)
    {
        $connection = $this->getDoctrine()->getManager();
        $currentServer = $connection->getRepository(Server::class)->find($id);
        if (empty($currentServer)) {
            return new Response("Server $id not exist", Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $selectedLocation = $connection->getRepository(Location::class)->find($data['location_id']);
        $selectedOwner = $connection->getRepository(Owner::class)->find($data['owner_id']);

        if (!empty($data['name'])) {
            $currentServer->setName($data['name']);
        }
        if (!empty($data['type'])) {
            $currentServer->setType($data['type']);
        }
        if (!empty($data['description'])) {
            $currentServer->setDescription($data['description']);
        }
        if (!empty($selectedLocation)) {
            $currentServer->setLocationId($selectedLocation);
        }
        if (!empty($selectedOwner)) {
            $currentServer->setOwnerId($selectedOwner);
        }

        $connection->persist($currentServer);
        $connection->flush();
        return new Response("Updated server ". $currentServer->getId(), Response::HTTP_OK);
    }
}