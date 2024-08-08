<?php

namespace Albatross;

class EntityDTO
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var int
     */
    private $model_id;

    /**
     * @var int $sponsor_id
     */
    private $sponsor_id;

	/**
	 * @var string $invoice_pattern
	 */
	private $invoice_pattern;

	/**
	 * @var string $replacement_invoice_pattern
	 */
	private $replacement_invoice_pattern;

	/**
	 * @var string $credit_note_pattern
	 */
	private $credit_note_pattern;

	/**
	 * @var string $down_payment_invoice_pattern
	 */
	private $down_payment_invoice_pattern;

	/**
	 * @var string $propal_pattern
	 */
	private $propal_pattern;

	/**
	 * @var string $customer_code_pattern
	 */
	private $customer_code_pattern;

	/**
	 * @var string $supplier_code_pattern
	 */
	private $supplier_code_pattern;

	/**
	 * @var bool $end_patterns_with_id
	 */
	private $end_patterns_with_id;

	/**
	 * @var bool $vat_used
	 */
	private $vat_used;

	public function __construct()
	{
		$this->label = '';
		$this->name = '';
		$this->address = '';
		$this->zipCode = '';
		$this->city = '';
		$this->model_id = 0;
		$this->sponsor_id = 0;
	}

	public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): EntityDTO
    {
        $this->label = $label;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EntityDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): EntityDTO
    {
        $this->address = $address;
        return $this;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): EntityDTO
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): EntityDTO
    {
        $this->city = $city;
        return $this;
    }

    public function getModel(): int
    {
        return $this->model_id;
    }

    public function setModel(int $model_id): EntityDTO
    {
        $this->model_id = $model_id;
        return $this;
    }

    public function getModelId(): int
    {
        return $this->model_id;
    }

    public function setModelId(int $model_id): EntityDTO
    {
        $this->model_id = $model_id;
        return $this;
    }

    public function getSponsorId(): int
    {
        return $this->sponsor_id;
    }

    public function setSponsorId($sponsor_id): EntityDTO
    {
        $this->sponsor_id = $sponsor_id;
        return $this;
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach (get_object_vars($this) as $key => $value) {
            $attributes[$key] = $value;
        }

        return $attributes;
    }

	public function getInvoicePattern(): string
	{
		return $this->invoice_pattern;
	}

	public function setInvoicePattern(string $invoice_pattern): EntityDTO
	{
		$this->invoice_pattern = $invoice_pattern;
		return $this;
	}

	public function getReplacementInvoicePattern(): string
	{
		return $this->replacement_invoice_pattern;
	}

	public function setReplacementInvoicePattern(string $replacement_invoice_pattern): EntityDTO
	{
		$this->replacement_invoice_pattern = $replacement_invoice_pattern;
		return $this;
	}

	public function getCreditNotePattern(): string
	{
		return $this->credit_note_pattern;
	}

	public function setCreditNotePattern(string $credit_note_pattern): EntityDTO
	{
		$this->credit_note_pattern = $credit_note_pattern;
		return $this;
	}

	public function getDownPaymentInvoicePattern(): string
	{
		return $this->down_payment_invoice_pattern;
	}

	public function setDownPaymentInvoicePattern(string $down_payment_invoice_pattern): EntityDTO
	{
		$this->down_payment_invoice_pattern = $down_payment_invoice_pattern;
		return $this;
	}

	public function getPropalPattern(): string
	{
		return $this->propal_pattern;
	}

	public function setPropalPattern(string $propal_pattern): EntityDTO
	{
		$this->propal_pattern = $propal_pattern;
		return $this;
	}

	public function getCustomerCodePattern(): string
	{
		return $this->customer_code_pattern;
	}

	public function setCustomerCodePattern(string $customer_code_pattern): EntityDTO
	{
		$this->customer_code_pattern = $customer_code_pattern;
		return $this;
	}

	public function getSupplierCodePattern(): string
	{
		return $this->supplier_code_pattern;
	}

	public function setSupplierCodePattern(string $supplier_code_pattern): EntityDTO
	{
		$this->supplier_code_pattern = $supplier_code_pattern;
		return $this;
	}

	public function isEndPatternsWithId(): bool
	{
		return $this->end_patterns_with_id;
	}

	public function setEndPatternsWithId(bool $end_patterns_with_id): EntityDTO
	{
		$this->end_patterns_with_id = $end_patterns_with_id;
		return $this;
	}

	public function getVatUsed(): bool
	{
		return $this->vat_used;
	}

	public function setVatUsed(bool $vat_used): EntityDTO
	{
		$this->vat_used = $vat_used;
		return $this;
	}
}
