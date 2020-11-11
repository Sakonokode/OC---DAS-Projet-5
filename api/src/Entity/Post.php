<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\EntityTrait;
use App\Traits\CommentableTrait;
use App\Traits\DescribableTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\CategorizableTrait;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource
 */
class Post
{
    use EntityTrait;
    use DescribableTrait;
    use CommentableTrait;
    use CategorizableTrait;

    /**
     * @var User $author
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected User $author;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}
