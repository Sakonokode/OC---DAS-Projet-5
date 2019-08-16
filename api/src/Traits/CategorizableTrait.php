<?php

namespace App\Traits;

use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait CategorizableTrait
 * @package App\Traits
 */
trait CategorizableTrait
{
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinTable(
     *     joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="categories_id", referencedColumnName="id")}
     * )
     */
    protected $categories;

    /**
     * CategorizableTrait constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @param Category $category
     */
    public function addCategory(Category $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category): void
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
    }
}
