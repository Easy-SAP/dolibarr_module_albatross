<?php

namespace test\functional;

define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__, 2).'/inc/mappers/UserDTOMapper.class.php';

use PHPUnit\Framework\TestCase;

class UserMapperTest extends TestCase
{
    public function testUserDTOMapperConvertsToUserDTO()
    {
        global $db;
        $user = new \User($db);
        $user->firstname = 'John';
        $user->lastname = 'Doe';
        $user->email = 'john.doe@example.com';
        $user->office_phone = '1234567890';
        $user->address = '123 Main St';
        $user->zip = '12345';
        $user->town = 'Test City';

        $mapper = new \Albatross\UserDTOMapper();
        $userDTO = $mapper->toUserDTO($user);

        $this->assertEquals('John', $userDTO->getFirstname());
        $this->assertEquals('Doe', $userDTO->getLastname());
        $this->assertEquals('john.doe@example.com', $userDTO->getEmail());
        $this->assertEquals('1234567890', $userDTO->getPhone());
        $this->assertEquals('123 Main St', $userDTO->getAddress());
        $this->assertEquals('12345', $userDTO->getZipCode());
        $this->assertEquals('Test City', $userDTO->getCity());
    }

    public function testUserDTOMapperConvertsToUser()
    {
        global $db;
        $userDTO = new \Albatross\UserDTO();
        $userDTO->setFirstname('John');
        $userDTO->setLastname('Doe');
        $userDTO->setEmail('john.doe@example.com');
        $userDTO->setPhone('1234567890');
        $userDTO->setAddress('123 Main St');
        $userDTO->setZipCode('12345');
        $userDTO->setCity('Test City');

        $mapper = new \Albatross\UserDTOMapper();
        $user = $mapper->toUser($userDTO);

        $this->assertEquals('John', $user->firstname);
        $this->assertEquals('Doe', $user->lastname);
        $this->assertEquals('john.doe@example.com', $user->email);
        $this->assertEquals('1234567890', $user->office_phone);
        $this->assertEquals('123 Main St', $user->address);
        $this->assertEquals('12345', $user->zip);
        $this->assertEquals('Test City', $user->town);
    }

    public function testUserDTOMapperHandlesEmptyUser()
    {
        global $db;
        $user = new \User($db);

        $mapper = new \Albatross\UserDTOMapper();
        $userDTO = $mapper->toUserDTO($user);

        $this->assertNull($userDTO->getFirstname());
        $this->assertNull($userDTO->getLastname());
        $this->assertNull($userDTO->getEmail());
        $this->assertNull($userDTO->getPhone());
        $this->assertNull($userDTO->getAddress());
        $this->assertNull($userDTO->getZipCode());
        $this->assertNull($userDTO->getCity());
    }

    public function testUserDTOMapperHandlesEmptyUserDTO()
    {
        global $db;
        $userDTO = new \Albatross\UserDTO();

        $mapper = new \Albatross\UserDTOMapper();
        $user = $mapper->toUser($userDTO);

        $this->assertNull($user->firstname);
        $this->assertNull($user->lastname);
        $this->assertNull($user->email);
        $this->assertNull($user->office_phone);
        $this->assertNull($user->address);
        $this->assertNull($user->zip);
        $this->assertNull($user->town);
    }
}
