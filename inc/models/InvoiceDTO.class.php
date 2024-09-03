<?php

namespace Albatross;

require_once __DIR__ . '/InvoiceLineDTO.class.php';
use Albatross\InvoiceLineDTO;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical;

class InvoiceStatus {
    const DRAFT = 0;
    const VALIDATED = 1;
    const SENT = 2;
    const PAID = 3;
    const CANCELLED = -1;
}

class InvoiceDTO
{
    /**
     * @var \DateTime
     */
    private $date;
    private int $status;

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

    private ?int $project;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->status = InvoiceStatus::DRAFT;
        $this->customerId = 0;
        $this->supplierId = 0;
        $this->invoiceLines = [];

        // optional
        $this->project = null;
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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): InvoiceDTO
    {
        $this->status = $status;
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

    public function getProject(): ?int
    {
        return $this->project;
    }

    public function setProject(int $project): InvoiceDTO
    {
        $this->project = $project;
        return $this;
    }
}
