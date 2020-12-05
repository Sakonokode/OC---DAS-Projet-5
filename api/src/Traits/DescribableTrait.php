<?php

namespace App\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

trait DescribableTrait
{
    /**
     * @var string $title
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"post"})
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $slug;

    /**
     * @var string|null $content
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Groups({"post"})
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $content;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
