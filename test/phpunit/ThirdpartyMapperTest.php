<?php

namespace test\functional;

// Prepare the environment
if (!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__) . '/_setup.php';
}

require_once dirname(__DIR__, 2) . '/inc/mappers/ThirdpartyDTOMapper.class.php';

use Albatross\ThirdpartyDTO;
use Albatross\ThirdpartyDTOMapper;
use PHPUnit\Framework\TestCase;
use Societe;

class ThirdpartyMapperTest extends TestCase
{
    public function testThirdpartyDTOMapperConvertsToThirdpartyDTO()
    {
        global $db;
        $thirdparty = new Societe($db);
        $thirdparty->name = 'Test Name';
        $thirdparty->address = 'Test Address';
        $thirdparty->zip = '12345';
        $thirdparty->town = 'Test City';
        $thirdparty->email = 'test@example.com';
        $thirdparty->phone = '1234567890';
        $thirdparty->idprof2 = '123456789';
        $thirdparty->tva_assuj = 0;

        $mapper = new ThirdpartyDTOMapper();
        $thirdpartyDTO = $mapper->toThirdpartyDTO($thirdparty);

        $this->assertEquals('Test Name', $thirdpartyDTO->getName());
        $this->assertEquals('Test Address', $thirdpartyDTO->getAddress());
        $this->assertEquals('12345', $thirdpartyDTO->getZipCode());
        $this->assertEquals('Test City', $thirdpartyDTO->getCity());
        $this->assertEquals('test@example.com', $thirdpartyDTO->getEmail());
        $this->assertEquals('1234567890', $thirdpartyDTO->getPhone());
        $this->assertEquals('123456789', $thirdpartyDTO->getSiret());
        $this->assertFalse($thirdpartyDTO->isVatUsed());
    }

    public function testThirdpartyDTOMapperConvertsToSupplier()
    {
        global $db, $conf;
        $thirdpartyDTO = new ThirdpartyDTO();
        $thirdpartyDTO->setName('Test Supplier');
        $thirdpartyDTO->setAddress('Test Address');
        $thirdpartyDTO->setZipCode('12345');
        $thirdpartyDTO->setCity('Test City');
        $thirdpartyDTO->setEmail('test@example.com');
        $thirdpartyDTO->setPhone('1234567890');
        $thirdpartyDTO->setSiret('123456789');

        $mapper = new ThirdpartyDTOMapper();
        $supplier = $mapper->toSupplier($thirdpartyDTO);

        $this->assertEquals('Test Supplier', $supplier->name);
        $this->assertEquals('Test Address', $supplier->address);
        $this->assertEquals('12345', $supplier->zip);
        $this->assertEquals('Test City', $supplier->town);
        $this->assertEquals('test@example.com', $supplier->email);
        $this->assertEquals('1234567890', $supplier->phone);
        $this->assertEquals('123456789', $supplier->idprof2);
        $this->assertEquals(1, $supplier->fournisseur);
        $this->assertEquals(1, $supplier->tva_assuj);
    }

    public function testThirdpartyDTOMapperConvertsToCustomer()
    {
        global $db, $conf;
        $thirdpartyDTO = new ThirdpartyDTO();
        $thirdpartyDTO->setName('Test Customer');
        $thirdpartyDTO->setAddress('Test Address');
        $thirdpartyDTO->setZipCode('12345');
        $thirdpartyDTO->setCity('Test City');
        $thirdpartyDTO->setEmail('test@example.com');
        $thirdpartyDTO->setPhone('1234567890');
        $thirdpartyDTO->setSiret('123456789');

        $mapper = new ThirdpartyDTOMapper();
        $customer = $mapper->toCustomer($thirdpartyDTO);

        $this->assertEquals('Test Customer', $customer->name);
        $this->assertEquals('Test Address', $customer->address);
        $this->assertEquals('12345', $customer->zip);
        $this->assertEquals('Test City', $customer->town);
        $this->assertEquals('test@example.com', $customer->email);
        $this->assertEquals('1234567890', $customer->phone);
        $this->assertEquals('123456789', $customer->idprof2);
        $this->assertEquals(1, $customer->client);
        $this->assertEquals(1, $customer->tva_assuj);
    }

    public function testThirdpartyDTOMapperHandlesEmptyThirdparty()
    {
        global $db;
        $thirdparty = new Societe($db);

        $mapper = new ThirdpartyDTOMapper();
        $thirdpartyDTO = $mapper->toThirdpartyDTO($thirdparty);

        $this->assertEmpty($thirdpartyDTO->getName());
        $this->assertEmpty($thirdpartyDTO->getAddress());
        $this->assertEmpty($thirdpartyDTO->getZipCode());
        $this->assertEmpty($thirdpartyDTO->getCity());
        $this->assertEmpty($thirdpartyDTO->getEmail());
        $this->assertEmpty($thirdpartyDTO->getPhone());
        $this->assertEmpty($thirdpartyDTO->getSiret());
        $this->assertTrue($thirdpartyDTO->isVatUsed()); // Forced by Dolibarr => If nothing is set, it is true
    }

    public function testThirdpartyDTOMapperHandlesEmptyThirdpartyDTO()
    {
        global $db, $conf;
        $thirdpartyDTO = new ThirdpartyDTO();

        $mapper = new ThirdpartyDTOMapper();
        $thirdparty = $mapper->toSupplier($thirdpartyDTO);

        $this->assertEmpty($thirdparty->name);
        $this->assertEmpty($thirdparty->address);
        $this->assertEmpty($thirdparty->zip);
        $this->assertEmpty($thirdparty->town);
        $this->assertEmpty($thirdparty->email);
        $this->assertEmpty($thirdparty->phone);
        $this->assertEmpty($thirdparty->idprof2);
        $this->assertEquals(1, $thirdparty->fournisseur);
        $this->assertEquals(1, $thirdparty->tva_assuj);
    }
}
