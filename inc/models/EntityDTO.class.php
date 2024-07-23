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
     * @var int
     */
    private $sponsor_id;

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
}
