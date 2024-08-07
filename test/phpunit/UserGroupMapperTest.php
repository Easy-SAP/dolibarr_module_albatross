<?php

namespace test\functional;
define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__,2).'/inc/mappers/UserGroupDTOMapper.class.php';

use PHPUnit\Framework\TestCase;

class UserGroupMapperTest extends TestCase
{
	public function testUserGroupDTOMapperConvertsToUserGroupDTO()
	{
		$userGroup = new \UserGroup($db);
		$userGroup->id = 1;
		$userGroup->name = 'Admin';

		$mapper = new \Albatross\UserGroupDTOMapper();
		$userGroupDTO = $mapper->toUserGroupDTO($userGroup);

		$this->assertEquals(1, $userGroupDTO->getId());
		$this->assertEquals('Admin', $userGroupDTO->getLabel());
	}

	public function testUserGroupDTOMapperConvertsToUserGroup()
	{
		global $db;
		$userGroupDTO = new \Albatross\UserGroupDTO();
		$userGroupDTO->setId(1);
		$userGroupDTO->setLabel('Admin');

		$mapper = new \Albatross\UserGroupDTOMapper();
		$userGroup = $mapper->toUserGroup($userGroupDTO);

		$this->assertEquals(1, $userGroup->id);
		$this->assertEquals('Admin', $userGroup->name);
	}

	public function testUserGroupDTOMapperHandlesEmptyUserGroup()
	{
		$userGroup = new \UserGroup($db);

		$mapper = new \Albatross\UserGroupDTOMapper();
		$userGroupDTO = $mapper->toUserGroupDTO($userGroup);

		$this->assertNull($userGroupDTO->getId());
		$this->assertNull($userGroupDTO->getLabel());
	}

	public function testUserGroupDTOMapperHandlesEmptyUserGroupDTO()
	{
		global $db;
		$userGroupDTO = new \Albatross\UserGroupDTO();

		$mapper = new \Albatross\UserGroupDTOMapper();
		$userGroup = $mapper->toUserGroup($userGroupDTO);

		$this->assertNull($userGroup->id);
		$this->assertNull($userGroup->name);
	}
}
