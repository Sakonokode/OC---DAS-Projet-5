<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource
 * 
 */
class Comment
{
    use EntityTrait;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="comment.blank")
     * @Assert\Length(
     *     min=5,
     *     minMessage="comment.too_short",
     *     max=10000,
     *     maxMessage="comment.too_long"
     * )
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private string $content;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private User $author;

    /**
     * @var Children[]|Collection
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="parent", cascade={"persist"})
     * 
     * @psalm-var Collection<int, Comment>
     */
    private $children;

    /**
     * @var Comment|null
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="children")
     * 
     * @psalm-suppress MissingPropertyType
     */
    private $parent;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function addChildren(Comment $children): void
    {
        if (!$this->children->contains($children)) {
            $this->children->add($children);
        }
    }

    public function removeChildren(Comment $children): void
    {
        if ($this->children->contains($children)) {
            $this->children->removeElement($children);
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getChildren(): ?Collection
    {
        return $this->children;
    }

    public function getParent(): ?Comment
    {
        return $this->parent;
    }

    public function setParent(Comment $parent): void
    {
        $this->parent = $parent;
    }
}
