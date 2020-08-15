<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServerRepository::class)
 */
class Server
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="servers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locationId;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="servers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ownerId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocationId(): ?Location
    {
        return $this->locationId;
    }

    public function setLocationId(?Location $locationId): self
    {
        $this->locationId = $locationId;

        return $this;
    }

    public function getOwnerId(): ?Owner
    {
        return $this->ownerId;
    }

    public function setOwnerId(?Owner $ownerId): self
    {
        $this->ownerId = $ownerId;

        return $this;
    }
}
