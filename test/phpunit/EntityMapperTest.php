<?php

namespace test\functional;
define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__,2).'/inc/mappers/EntityDTOMapper.class.php';


use PHPUnit\Framework\TestCase;

class EntityMapperTest extends TestCase
{
	public function testEntityMapperConvertsToEntity()
	{
		// Control transaltions
		$entityDTO = new \Albatross\EntityDTO();
		$entityDTO->setLabel('Test Label');
		$entityDTO->setName('Test Name');
		$entityDTO->setModel(1);
		$entityDTO->setAddress('Test Address');
		$entityDTO->setZipCode('12345');
		$entityDTO->setCity('Test City');

		$mapper = new \Albatross\EntityDTOMapper();
		$entity = $mapper->toEntity($entityDTO);

		$this->assertEquals('Test Label', $entity->label);
		$this->assertEquals('Test Name', $entity->name);
		$this->assertEquals(1, $entity->usetemplate);
		$this->assertEquals('Test Address', $entity->address);
		$this->assertEquals('12345', $entity->zipcode);
		$this->assertEquals('Test City', $entity->town);
	}

	public function testEntityDTOMapperHandlesEmptyEntity()
	{
		global $db;
		$entity = new \DaoMulticompany($db);

		$mapper = new \Albatross\EntityDTOMapper();

		$this->expectExceptionMessage('Field label is required and cannot be null');
		$mapper->toEntityDTO($entity);
	}

	public function testEntityDTOMapperHandlesEmptyEntityDTO()
	{
		$entityDTO = new \Albatross\EntityDTO();

		$mapper = new \Albatross\EntityDTOMapper();

		$this->expectException('Error');
		$entity = $mapper->toEntity($entityDTO);

		$entityDTO->setLabel('Test Label');

		$this->assertNull($entity->name);
		$this->assertNull($entity->usetemplate);
		$this->assertEmpty($entity->address);
		$this->assertEmpty($entity->zipcode);
		$this->assertNull($entity->town);
	}

	public function testEntityDTOMapperHandlesEntityDTOWithMinimumValue()
	{
		$entityDTO = new \Albatross\EntityDTO();
		$entityDTO->setName('Test Name');

		$mapper = new \Albatross\EntityDTOMapper();

		$entity = $mapper->toEntity($entityDTO);

		$this->assertEquals('Test Name', $entity->name);
		$this->assertEmpty($_POST['usetemplate']);
		$this->assertEmpty($_POST['address']);
		$this->assertEmpty($_POST['zipcode']);
		$this->assertEmpty($_POST['town']);
	}
}
