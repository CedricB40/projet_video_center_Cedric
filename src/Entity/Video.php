<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Trait\TimestampableTrait; //ajout de l'appel du trait

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ORM\HasLifecycleCallbacks] //permet à Doctrine d'appeler automatiquement les méthodes du trait (PrePersist/PreUpdate) pour gérer createdAt/updatedAt
#[ORM\Table(name: 'videos')] //on renomme la table en "videos" avec un "s" (convention CFITECH)
class Video
{
    use TimestampableTrait; //ajout de l'appel de TimestampableTrait

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $videoLink = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)] //nullable à false : une vidéo doit obligatoirement avoir un auteur dès sa création (cohérent avec le flow d'authentification de la Phase 5)
    private ?User $auteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(string $videoLink): static
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

}