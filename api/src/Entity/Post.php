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
use App\Annotation\UserAware;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @ApiResource(normalizationContext={"groups"={"post"}})
 * 
 * @UserAware(userFieldName="user_id")
 * 
 */
class Post
{
    use EntityTrait;
    use DescribableTrait;
    use CommentableTrait;
    use CategorizableTrait;

    /**
     * @var User $author
     * 
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     * 
     * @Groups({"post"})
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private User $author;

    /**
     * @var MediaObject|null
     *
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://projet5.sakonokode.dev/api/image")
     */
    public ?MediaObject $image;

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

    public function getImage(): ?MediaObject
    {
        return $this->media;
    }

    public function setImage(MediaObject $media): void
    {
        $this->media = $media;
    }
}
