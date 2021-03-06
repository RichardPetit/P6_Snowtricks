<?php

namespace App\Entity;

use App\Repository\TricksRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TricksRepository::class)
 * @UniqueEntity(fields={"name"}, message="Ce nom est déjà utilisé")
 */
class Trick
{
    public const TRICK_CATEGORY = [
        'Grab'       => "grab",
        'Rotation'   => "rotation",
        'Flip'       => "flip",
        'Slide'      => "slide",
        'One-foot'   => "one-foot",
        'Old-school' => "old-school",
    ];

    public const TRICK_CATEGORY_DISPLAY = [
        'grab'       => "Grab",
        'rotation'   => "Rotation",
        'flip'       => "Flip",
        'slide'      => "Slide",
        'one-foot'   => "One-foot",
        'old-school' => "Old-school",
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(min=4, minMessage="Le nom doit faire 4 caractères minimum.")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeImmutable $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="trick", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=TrickMedia::class, mappedBy="trick")
     */
    private $medias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=Trick::TRICK_CATEGORY, message="Choisissez une valeure valide.")
     */
    private $category;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->comments = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function generateSlug(): self
    {
        $name = $this->getName();
        $slugify = new Slugify();
        $slug = $slugify->slugify($name);
        $this->setSlug($slug);

        return $this;
    }

    /**
     * @return Collection|TrickMedia[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMainImage(): string
    {
        $medias = $this->getMedias();
        foreach ($medias as $media) {
            if ($media->isImage()) {
                return $media->getLink();
            }
        }

        return TrickMedia::DEFAULT_IMAGE;
    }

    public function getDisplayCategory(): string
    {
        $category = $this->getCategory();
        if ($category === null) {
            return '';
        }
        return self::TRICK_CATEGORY_DISPLAY[$category];

    }
}
