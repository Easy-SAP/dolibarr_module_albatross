<?php


class OrderLineDTO
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

    public function setDate(\DateTime $date): OrderLineDTO
    {
        $this->date = $date;
        return $this;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): OrderLineDTO
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): OrderLineDTO
    {
        $this->supplierId = $supplierId;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): OrderLineDTO
    {
        $this->productId = $productId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): OrderLineDTO
    {
        $this->quantity = $quantity;
        return $this;
    }
}
