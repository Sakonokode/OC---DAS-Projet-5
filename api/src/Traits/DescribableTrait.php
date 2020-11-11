<?php

namespace App\Traits;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait DescribableTrait
 * @package App\Traits
 */
trait DescribableTrait
{
    /**
     * @var string $title
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $title;

    /**
     * @var string|null $description
     * @ORM\Column(type="text", nullable=true)
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $description;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
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
