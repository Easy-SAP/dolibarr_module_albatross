<?php

namespace test\functional;
define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__,2).'/inc/mappers/ThirdpartyDTOMapper.class.php';

use PHPUnit\Framework\TestCase;

class ThirdpartyMapperTest extends TestCase
{
	public function testThirdpartyDTOMapperConvertsToThirdpartyDTO()
	{
		global $db;
		$thirdparty = new \Societe($db);
		$thirdparty->name = 'Test Name';
		$thirdparty->address = 'Test Address';
		$thirdparty->zip = '12345';
		$thirdparty->town = 'Test City';
		$thirdparty->email = 'test@example.com';
		$thirdparty->phone = '1234567890';
		$thirdparty->idprof2 = '123456789';

		$mapper = new \Albatross\ThirdpartyDTOMapper();
		$thirdpartyDTO = $mapper->toThirdpartyDTO($thirdparty);

		$this->assertEquals('Test Name', $thirdpartyDTO->getName());
		$this->assertEquals('Test Address', $thirdpartyDTO->getAddress());
		$this->assertEquals('12345', $thirdpartyDTO->getZipCode());
		$this->assertEquals('Test City', $thirdpartyDTO->getCity());
		$this->assertEquals('test@example.com', $thirdpartyDTO->getEmail());
		$this->assertEquals('1234567890', $thirdpartyDTO->getPhone());
		$this->assertEquals('123456789', $thirdpartyDTO->getSiret());
	}

	public function testThirdpartyDTOMapperConvertsToSupplier()
	{
		global $db, $conf;
		$thirdpartyDTO = new \Albatross\ThirdpartyDTO();
		$thirdpartyDTO->setName('Test Supplier');
		$thirdpartyDTO->setAddress('Test Address');
		$thirdpartyDTO->setZipCode('12345');
		$thirdpartyDTO->setCity('Test City');
		$thirdpartyDTO->setEmail('test@example.com');
		$thirdpartyDTO->setPhone('1234567890');
		$thirdpartyDTO->setSiret('123456789');

		$mapper = new \Albatross\ThirdpartyDTOMapper();
		$supplier = $mapper->toSupplier($thirdpartyDTO);

		$this->assertEquals('Test Supplier', $supplier->name);
		$this->assertEquals('Test Address', $supplier->address);
		$this->assertEquals('12345', $supplier->zip);
		$this->assertEquals('Test City', $supplier->town);
		$this->assertEquals('test@example.com', $supplier->email);
		$this->assertEquals('1234567890', $supplier->phone);
		$this->assertEquals('123456789', $supplier->idprof2);
		$this->assertEquals(1, $supplier->fournisseur);
	}

	public function testThirdpartyDTOMapperConvertsToCustomer()
	{
		global $db, $conf;
		$thirdpartyDTO = new \Albatross\ThirdpartyDTO();
		$thirdpartyDTO->setName('Test Customer');
		$thirdpartyDTO->setAddress('Test Address');
		$thirdpartyDTO->setZipCode('12345');
		$thirdpartyDTO->setCity('Test City');
		$thirdpartyDTO->setEmail('test@example.com');
		$thirdpartyDTO->setPhone('1234567890');
		$thirdpartyDTO->setSiret('123456789');

		$mapper = new \Albatross\ThirdpartyDTOMapper();
		$customer = $mapper->toCustomer($thirdpartyDTO);

		$this->assertEquals('Test Customer', $customer->name);
		$this->assertEquals('Test Address', $customer->address);
		$this->assertEquals('12345', $customer->zip);
		$this->assertEquals('Test City', $customer->town);
		$this->assertEquals('test@example.com', $customer->email);
		$this->assertEquals('1234567890', $customer->phone);
		$this->assertEquals('123456789', $customer->idprof2);
		$this->assertEquals(1, $customer->client);
	}

	public function testThirdpartyDTOMapperHandlesEmptyThirdparty()
	{
		global $db;
		$thirdparty = new \Societe($db);

		$mapper = new \Albatross\ThirdpartyDTOMapper();
		$thirdpartyDTO = $mapper->toThirdpartyDTO($thirdparty);

		$this->assertNull($thirdpartyDTO->getName());
		$this->assertNull($thirdpartyDTO->getAddress());
		$this->assertNull($thirdpartyDTO->getZipCode());
		$this->assertNull($thirdpartyDTO->getCity());
		$this->assertNull($thirdpartyDTO->getEmail());
		$this->assertNull($thirdpartyDTO->getPhone());
		$this->assertNull($thirdpartyDTO->getSiret());
	}

	public function testThirdpartyDTOMapperHandlesEmptyThirdpartyDTO()
	{
		global $db, $conf;
		$thirdpartyDTO = new \Albatross\ThirdpartyDTO();

		$mapper = new \Albatross\ThirdpartyDTOMapper();
		$thirdparty = $mapper->toSupplier($thirdpartyDTO);

		$this->assertNull($thirdparty->name);
		$this->assertNull($thirdparty->address);
		$this->assertNull($thirdparty->zip);
		$this->assertNull($thirdparty->town);
		$this->assertNull($thirdparty->email);
		$this->assertNull($thirdparty->phone);
		$this->assertNull($thirdparty->idprof2);
		$this->assertEquals(1, $thirdparty->fournisseur);
	}
}
