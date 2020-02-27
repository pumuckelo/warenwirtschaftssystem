<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;


    /**
     * @ORM\OneToMany(targetEntity="IncomingDelivery", mappedBy="product")
     */
    private $incomingDeliveries;

    public function __construct()
    {
        $this->incomingDeliveries = new ArrayCollection();
    }

    //Getter Functions and Setter Functions

    //Getter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    //Setter
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

    /**
     * @return Collection|IncomingDelivery[]
     */
    public function getIncomingDeliveries(): Collection
    {
        return $this->incomingDeliveries;
    }

    public function addIncomingDelivery(IncomingDelivery $incomingDelivery): self
    {
        if (!$this->incomingDeliveries->contains($incomingDelivery)) {
            $this->incomingDeliveries[] = $incomingDelivery;
            $incomingDelivery->setProduct($this);
        }

        return $this;
    }

    public function removeIncomingDelivery(IncomingDelivery $incomingDelivery): self
    {
        if ($this->incomingDeliveries->contains($incomingDelivery)) {
            $this->incomingDeliveries->removeElement($incomingDelivery);
            // set the owning side to null (unless already changed)
            if ($incomingDelivery->getProduct() === $this) {
                $incomingDelivery->setProduct(null);
            }
        }

        return $this;
    }
}
