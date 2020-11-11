<?php

namespace App\Traits;

use App\Entity\Category;
use Doctrine\Common\Collections\Collection;

/**
 * Trait CategorizableTrait
 * @package App\Traits
 */
trait CategorizableTrait
{
    /**
     * @var Category[]|Collection
     * 
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="categories_id", referencedColumnName="id")}
     * )
     * @psalm-var Collection<int, Category>
     */
    protected $categories;

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    public function removeCategory(Category $category): void
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
    }
}
