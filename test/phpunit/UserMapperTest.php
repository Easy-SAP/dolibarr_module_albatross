<?php

namespace test\functional;

// Prepare the environment
if (!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__) . '/_setup.php';
}

require_once dirname(__DIR__, 2) . '/inc/mappers/UserDTOMapper.class.php';

use Albatross\UserDTO;
use Albatross\UserDTOMapper;
use PHPUnit\Framework\TestCase;
use User;

class UserMapperTest extends TestCase
{
    public function testUserDTOMapperConvertsToUserDTO()
    {
        global $db;
        $user = new User($db);
        $user->firstname = 'John';
        $user->lastname = 'Doe';
        $user->email = 'john.doe@example.com';
        $user->office_phone = '1234567890';
        $user->address = '123 Main St';
        $user->zip = '12345';
        $user->town = 'Test City';

        $mapper = new UserDTOMapper();
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
        $userDTO = new UserDTO();
        $userDTO->setFirstname('John');
        $userDTO->setLastname('Doe');
        $userDTO->setEmail('john.doe@example.com');
        $userDTO->setPhone('1234567890');
        $userDTO->setAddress('123 Main St');
        $userDTO->setZipCode('12345');
        $userDTO->setCity('Test City');

        $mapper = new UserDTOMapper();
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
        $user = new User($db);

        $mapper = new UserDTOMapper();
        $userDTO = $mapper->toUserDTO($user);

        $this->assertEmpty($userDTO->getFirstname());
        $this->assertEmpty($userDTO->getLastname());
        $this->assertEmpty($userDTO->getEmail());
        $this->assertEmpty($userDTO->getPhone());
        $this->assertEmpty($userDTO->getAddress());
        $this->assertEmpty($userDTO->getZipCode());
        $this->assertEmpty($userDTO->getCity());
    }

    public function testUserDTOMapperHandlesEmptyUserDTO()
    {
        global $db;
        $userDTO = new UserDTO();

        $mapper = new UserDTOMapper();
        $user = $mapper->toUser($userDTO);

        $this->assertEmpty($user->firstname);
        $this->assertEmpty($user->lastname);
        $this->assertEmpty($user->email);
        $this->assertEmpty($user->office_phone);
        $this->assertEmpty($user->address);
        $this->assertEmpty($user->zip);
        $this->assertEmpty($user->town);
    }
}
