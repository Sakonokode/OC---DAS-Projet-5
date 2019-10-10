<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\CategorizableTrait;
use App\Traits\CommentableTrait;
use App\Traits\DescribableTrait;
use App\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Post
 * @package App\Entity
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $author;

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}
