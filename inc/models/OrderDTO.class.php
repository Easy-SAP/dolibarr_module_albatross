<?php

namespace Albatross;

class OrderDTO
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var int
    */
    private $customerId;

    /**
     * @var int
     */
    private $supplierId;

    /**
     * @var int
     */
    private $productId;

    /**
     * @var int
     */
    private $quantity;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->quantity = 0;
        $this->productId = 0;
        $this->customerId = 0;
        $this->supplierId = 0;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): OrderDTO
    {
        $this->date = $date;
        return $this;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): OrderDTO
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): OrderDTO
    {
        $this->supplierId = $supplierId;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): OrderDTO
    {
        $this->productId = $productId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): OrderDTO
    {
        $this->quantity = $quantity;
        return $this;
    }
}
