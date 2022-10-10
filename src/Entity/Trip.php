<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TripRepository::class)]
#[ApiResource,ApiFilter(SearchFilter::class, properties: ['categories.name' => 'exact', 'tags.name' => 'exact','description' => 'partial'])]
#[GetCollection(normalizationContext: ['groups' => ['Trips','Trip_Tags','Trip_Categories']])]

class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Trips'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['Trips'])]
    private ?string $ville = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['Trips'])]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['Trips'])]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Trips'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['Trips'])]
    private ?int $nbParticipants = null;


    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'trips')]
    #[Groups(['Trips'])]
    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'trips')]
    #[Groups(['Trips'])]
    private Collection $categories;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

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

    public function getNbParticipants(): ?int
    {
        return $this->nbParticipants;
    }

    public function setNbParticipants(?int $nbParticipants): self
    {
        $this->nbParticipants = $nbParticipants;

        return $this;
    }


    /**
     * @return Collection<int, tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
}
