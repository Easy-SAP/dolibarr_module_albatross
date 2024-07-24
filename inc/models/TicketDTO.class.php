<?php

namespace Albatross;

class TicketDTO
{
    /**
     * @var string
     */
    private $entity_name;

    /**
     * @var string
     */
    private $entity_siret;

    /**
     * @var int
     */
    private $entity_model;

    /**
     * @var string
     */
    private $user_lastname;

    /**
     * @var string
     */
    private $user_firstname;

    /**
     * @var string
     */
    private $user_email;

    /**
     * @var string
     */
    private $user_phone;

    /**
     * @var string
     */
    private $user_address;

    /**
     * @var int
     */
    private $user_zipCode;

    /**
     * @var string
     */
    private $user_city;

    /**
     * @var int
     */
    private $entity_sponsor;

	public function __construct()
	{
		$this->user_phone = '';
		$this->user_address = '';
		$this->user_city = '';
		$this->user_zipCode = 0;
		$this->entity_sponsor = 0;
		$this->entity_model = 0;
	}

	public function getEntityName(): string
    {
        return $this->entity_name;
    }

    public function setEntityName(string $entity_name): TicketDTO
    {
        $this->entity_name = $entity_name;
        return $this;
    }

    public function getEntitySiret(): string
    {
        return $this->entity_siret;
    }

    public function setEntitySiret(string $entity_siret): TicketDTO
    {
        $this->entity_siret = $entity_siret;
        return $this;
    }

    public function getEntityModel(): int
    {
        return $this->entity_model ?? 0;
    }

    public function setEntityModel(int $entity_model): TicketDTO
    {
        $this->entity_model = $entity_model != -1 ? $entity_model : 0;
        return $this;
    }

    public function getUserLastname(): string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): TicketDTO
    {
        $this->user_lastname = strtoupper($user_lastname);
        return $this;
    }

    public function getUserFirstname(): string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): TicketDTO
    {
        $this->user_firstname = ucfirst($user_firstname);
        return $this;
    }

    public function getUserEmail(): string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): TicketDTO
    {
        $this->user_email = $user_email;
        return $this;
    }

    public function getUserPhone(): string
    {
        return $this->user_phone;
    }

    public function setUserPhone(string $user_phone): TicketDTO
    {
        $this->user_phone = $user_phone;
        return $this;
    }

    public function getUserAddress(): string
    {
        return $this->user_address;
    }

    public function setUserAddress(string $user_address): TicketDTO
    {
        $this->user_address = $user_address;
        return $this;
    }

    public function getUserZipCode(): int
    {
        return $this->user_zipCode;
    }

    public function setUserZipCode(int $user_zipCode): TicketDTO
    {
        $this->user_zipCode = $user_zipCode;
        return $this;
    }

    public function getUserCity(): string
    {
        return $this->user_city;
    }

    public function setUserCity(string $user_city): TicketDTO
    {
        $this->user_city = $user_city;
        return $this;
    }

    public function getEntitySponsor(): int
    {
        return $this->entity_sponsor;
    }

    public function setEntitySponsor(int $entity_sponsor): TicketDTO
    {
        $this->entity_sponsor = $entity_sponsor;
        return $this;
    }
}
