<?php

namespace Albatross;

require_once __DIR__ . '/OrderLineDTO.class.php';
use Albatross\OrderLineDTO;

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
	 * @var \OrderLineDTO[]
	 */
	private $orderLines;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->customerId = 0;
        $this->supplierId = 0;
		$this->orderLines = [];
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

	/**
	 * @return OrderLineDTO[]
	 */
	public function getOrderLines(): array
	{
		return $this->orderLines;
	}

	public function addOrderLine(OrderLineDTO $orderLine): OrderDTO
	{
		$this->orderLines[] = $orderLine;
		return $this;
	}
}
