<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\DescribableTrait;
use App\Traits\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource
 */
class Category
{
    use EntityTrait;
    use DescribableTrait;

    public function __toString(): string
    {
        return (string) $this->title;
    }
}