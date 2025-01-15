<?php

namespace Albatross;

class ThirdpartyDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $siret;

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
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var int
     */
    private $entity;

    /**
     * @var string
     */
    private $iban;

    /**
     * string
     */
    private $bic;

    /**
     * @var string
     */
    private $accountOwner;

    /**
     * @var bool
     */
    private $vat_used;

    public function __construct()
    {
        $this->name = '';
        $this->address = '';
        $this->zipCode = '';
        $this->city = '';
        $this->email = '';
        $this->phone = '';
        $this->entity = 0;
		$this->vat_used = true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ThirdpartyDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getSiret(): string
    {
        return $this->siret ?? '';
    }

    public function setSiret(string $siret): ThirdpartyDTO
    {
        $this->siret = $siret;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): ThirdpartyDTO
    {
        $this->address = $address;
        return $this;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): ThirdpartyDTO
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): ThirdpartyDTO
    {
        $this->city = $city;
        return $this;
    }

    public function setDpt(string $dpt): ThirdpartyDTO
    {
        $this->fk_departement = $dpt;
        return $this;
    }

    public function getDpt(): string
    {
        return $this->fk_departement;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): ThirdpartyDTO
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): ThirdpartyDTO
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEntity(): int
    {
        return $this->entity;
    }

    public function setEntity(int $entity): ThirdpartyDTO
    {
        $this->entity = $entity;
        return $this;
    }

    public function getIban(): string
    {
        return $this->iban ?? '';
    }

    public function setIban(string $iban): ThirdpartyDTO
    {
        $this->iban = $iban;
        return $this;
    }

    public function getBic()
    {
        return $this->bic ?? '';
    }

    public function setBic($bic)
    {
        $this->bic = $bic;
        return $this;
    }

    public function getAccountOwner(): string
    {
        return $this->accountOwner ?? '';
    }

    public function setAccountOwner(string $accountOwner): ThirdpartyDTO
    {
        $this->accountOwner = $accountOwner;
        return $this;
    }

    public function isVatUsed(): bool
    {
        return $this->vat_used;
    }

    public function setVatUsed(bool $vat_used = true): ThirdpartyDTO
    {
        $this->vat_used = $vat_used;
        return $this;
    }
}
