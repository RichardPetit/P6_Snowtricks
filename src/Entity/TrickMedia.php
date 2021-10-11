<?php

namespace App\Entity;

use App\Repository\TrickMediaRepository;
use Doctrine\ORM\Mapping as ORM;
use RicardoFiorani\Matcher\VideoServiceMatcher;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TrickMediaRepository::class)
 */
class TrickMedia
{
    private const TYPE_IMAGE = 'image';
    private const TYPE_VIDEO = 'video';
    public const DEFAULT_IMAGE = '/img/BWk4bXVB.jpg';
    public const MEDIA_TYPE = [
        'Image' => TrickMedia::TYPE_IMAGE,
        'Video' => TrickMedia::TYPE_VIDEO,
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=15, minMessage="L'URL doit faire 15 caractères minimum.")
     * @Assert\Url(message = "le format de l'adresse n'est pas correct")
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function getEmbeddedUrlForVideo(): string
    {
        $vsm = new VideoServiceMatcher();
        $video = $vsm->parse($this->getLink());
        return $video->getEmbedUrl();

    }

    public function isImage(): bool
    {
        return $this->getType() === self::TYPE_IMAGE;
    }

    public function isVideo(): bool
    {
        return $this->getType() === self::TYPE_VIDEO;
    }
}
