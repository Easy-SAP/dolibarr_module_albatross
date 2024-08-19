<?php

namespace Albatross;

require_once __DIR__ . '/InvoiceLineDTO.class.php';
use Albatross\InvoiceLineDTO;

class InvoiceDTO
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
     * @var \InvoiceLineDTO[]
     */
    private $invoiceLines;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->customerId = 0;
        $this->supplierId = 0;
        $this->invoiceLines = [];
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): InvoiceDTO
    {
        $this->date = $date;
        return $this;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): InvoiceDTO
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): InvoiceDTO
    {
        $this->supplierId = $supplierId;
        return $this;
    }

    /**
     * @return InvoiceLineDTO[]
     */
    public function getInvoiceLines(): array
    {
        return $this->invoiceLines;
    }

    public function addInvoiceLine(InvoiceLineDTO $invoiceLine): InvoiceDTO
    {
        $this->invoiceLines[] = $invoiceLine;
        return $this;
    }
}
