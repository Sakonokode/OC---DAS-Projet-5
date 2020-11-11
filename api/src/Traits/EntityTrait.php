<?php

declare(strict_types=1);

namespace App\Traits;

use DateTime;
use Exception;

/**
 * Trait EntityTrait
 * @package Blog\Traits
 */
trait EntityTrait
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $id;

    /**
     * @var DateTime $created
     * @ORM\Column(type="datetime")
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $created;

    /**
     * @var DateTime $updated
     * @ORM\Column(type="datetime")
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $updated;

    /**
     * @var null|DateTime $deleted
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $deleted;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @throws Exception
     * 
     * @psalm-suppress DocblockTypeContradiction
     */
    public function autoUpdateDates(): void
    {
        if ($this->created === null) {
            $this->created = new DateTime('now');
        }
        $this->updated = new DateTime('now');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }

    public function getDeleted(): ?DateTime
    {
        return $this->deleted;
    }

    /**
     * @param DateTime|null $deleted
     * @throws Exception
     */
    public function setDeleted(?DateTime $deleted = null): void
    {
        $this->deleted = $deleted;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}