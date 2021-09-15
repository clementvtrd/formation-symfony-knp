<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

class Cake
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected float $price;
    protected string $createdAt;
    protected Collection $categories;

    public function __construct()
    {
        $this->createdAt = time();
        $this->categories = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    public function setCategories(ArrayCollection $categories): self
    {
        $this->categories = $categories;
        return $this;
    }
}