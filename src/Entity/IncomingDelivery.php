<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncomingProductRepository")
 */
class IncomingDelivery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="text")
     */
    private $invoiceNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $receiptDate;


    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="incomingDeliveries")
     */
        private $product;






    //Getter & Setter Functions
    //Getter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getInvoiceNumber(): ?string {
        return $this->invoiceNumber;
    }

    public function getReceiptDate() {
        return $this->receiptDate;
    }

    //Setter
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }


    public function setInvoiceNumber(string $invoiceNumber): self {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function setReceiptDate( $receiptDate): self {
        $this->receiptDate = $receiptDate;
        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }


}
