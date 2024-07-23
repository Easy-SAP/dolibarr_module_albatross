<?php

namespace Albatross;

class UserDTO
{
	/**
	 * @var string
	 */
	private $lastname;
	/**
	 * @var string
	 */
	private $firstname;
	/**
	 * @var string
	 */
	private $email;
	/**
	 * @var string
	 */
	private $phone;
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


	public function getLastname(): string
	{
		return $this->lastname;
	}

	public function setLastname($lastname): UserDTO
	{
		$this->lastname = $lastname;
		return $this;
	}

	public function getFirstname(): string
	{
		return $this->firstname;
	}

	public function setFirstname(string $firstname): UserDTO
	{
		$this->firstname = $firstname;
		return $this;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): UserDTO
	{
		$this->email = $email;
		return $this;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function setPhone(string $phone): UserDTO
	{
		$this->phone = $phone;
		return $this;
	}

	public function getAddress(): string
	{
		return $this->address;
	}

	public function setAddress(string $address): UserDTO
	{
		$this->address = $address;
		return $this;
	}

	public function getZipCode(): string
	{
		return $this->zipCode;
	}

	public function setZipCode(string $zipCode): UserDTO
	{
		$this->zipCode = $zipCode;
		return $this;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function setCity(string $city): UserDTO
	{
		$this->city = $city;
		return $this;
	}
}