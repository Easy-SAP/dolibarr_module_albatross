<?php

namespace Albatross;

class Gender
{
    public const UNDEFINED = 0;
    public const MALE = 1;
    public const FEMALE = 2;
    public const OTHER = 3;
}

class UserDTO
{
    /**
     * @var int $gender
     */
    private $gender;

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

    /**
     * @var UserGroupDTO[] $groups
     */
    private $groups;

    /**
     * @var int $entity_id
     */
    private $entity_id;

    public function __construct()
    {
        $this->lastname = '';
        $this->firstname = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->zipCode = '';
        $this->city = '';
    }

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

    public function getGender(): int
    {
        return $this->gender ?? Gender::UNDEFINED;
    }

    public function setGender(int $gender): UserDTO
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return UserGroupDTO[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroup(UserGroupDTO $group): UserDTO
    {
        $this->groups[] = $group;
        return $this;
    }

    public function removeGroup(int $groupId): UserDTO
    {
        foreach ($this->groups as $key => $value) {
            if ($value->getId() === $group) {
                unset($this->groups[$key]);
                break;
            }
        }

        return $this;
    }

    public function getEntity(): int
    {
        return $this->entity_id ?? 1;
    }

    public function setEntity(int $entity_id): UserDTO
    {
        $this->entity_id = $entity_id;
        return $this;
    }
}
