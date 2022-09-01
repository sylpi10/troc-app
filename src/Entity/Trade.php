<?php

namespace App\Entity;

use App\Repository\TradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TradeRepository::class)]
class Trade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'trades')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: ObjectToSell::class, inversedBy: 'trades')]
    private Collection $objects;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->objects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, ObjectToSell>
     */
    public function getObjects(): Collection
    {
        return $this->objects;
    }

    public function addObject(ObjectToSell $object): self
    {
        if (!$this->objects->contains($object)) {
            $this->objects->add($object);
        }

        return $this;
    }

    public function removeObject(ObjectToSell $object): self
    {
        $this->objects->removeElement($object);

        return $this;
    }
}
