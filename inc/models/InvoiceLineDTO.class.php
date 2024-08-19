<?php

namespace Albatross;

class InvoiceLineDTO
{
    /**
     * @var ?int
     */
    private $productId;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string description
     */
    private $description;

    /**
     * @var int $unitprice
     */
    private $unitprice;

    /**
     * @var int discount
     */
    private $discount;

    public function __construct()
    {
        $this->quantity = 1;
        $this->discount = 0;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): InvoiceLineDTO
    {
        $this->productId = $productId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): InvoiceLineDTO
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): InvoiceLineDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getUnitprice(): float
    {
        return $this->unitprice / 1000;
    }

    public function setUnitprice(float $unitprice): InvoiceLineDTO
    {
        $this->unitprice = $unitprice * 1000;
        return $this;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): InvoiceLineDTO
    {
        $this->discount = $discount;
        return $this;
    }
}