<?php

namespace App\Entity;

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
}
