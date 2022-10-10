<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource]
#[GetCollection(normalizationContext: ['groups' => ['Articles','Article_Tags','Article_Categories', 'Article_Author','Article_Photos']])]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['Articles'])]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['Articles'])]
    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[Groups(['Articles'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Articles'])]
    private ?User $auteur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['Articles'])]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'articles')]
    #[Groups(['Articles'])]
    private Collection $tag;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'articles')]
    #[Groups(['Articles'])]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commentaire::class, orphanRemoval: true)]
    #[Groups(['Articles'])]
    private Collection $commentaires;

    #[Groups(['Articles'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Photo::class, orphanRemoval: true)]
    #[Groups(['Articles'])]
    private Collection $photos;


    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categories->removeElement($categorie);

        return $this;
    }

    /**

     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setArticle($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getArticle() === $this) {
                $photo->setArticle(null);
            }
        }

        return $this;
    }





}
