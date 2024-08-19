<?php

namespace Albatross;

class ProductDTO
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var int
     */
    private $taxFreePrice;

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): ProductDTO
    {
        $this->label = $label;
        return $this;
    }

    public function getTaxFreePrice(): float
    {
        return (float) $this->taxFreePrice / 100;
    }

    public function setTaxFreePrice(float $taxFreePrice): ProductDTO
    {
        $this->taxFreePrice = (int) $taxFreePrice * 100;
        return $this;
    }
}
