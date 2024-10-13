<?php

namespace test\functional;

// Prepare the environment
if (!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__) . '/_setup.php';
}

require_once dirname(__DIR__, 2) . '/inc/mappers/UserGroupDTOMapper.class.php';

use Albatross\UserGroupDTO;
use Albatross\UserGroupDTOMapper;
use PHPUnit\Framework\TestCase;
use UserGroup;

class UserGroupMapperTest extends TestCase
{
    public function testUserGroupDTOMapperConvertsToUserGroupDTO()
    {
        global $db;

        $userGroup = new UserGroup($db);
        $userGroup->id = 1;
        $userGroup->name = 'Admin';

        $mapper = new UserGroupDTOMapper();
        $userGroupDTO = $mapper->toUserGroupDTO($userGroup);

        $this->assertEquals(1, $userGroupDTO->getId());
        $this->assertEquals('Admin', $userGroupDTO->getLabel());
    }

    public function testUserGroupDTOMapperConvertsToUserGroup()
    {
        global $db;
        $userGroupDTO = new UserGroupDTO();
        $userGroupDTO->setId(1);
        $userGroupDTO->setLabel('Admin');

        $mapper = new UserGroupDTOMapper();
        $userGroup = $mapper->toUserGroup($userGroupDTO);

        $this->assertEquals(1, $userGroup->id);
        $this->assertEquals('Admin', $userGroup->name);
    }

    public function testUserGroupDTOMapperHandlesEmptyUserGroup()
    {
        global $db;

        $userGroup = new UserGroup($db);

        $mapper = new UserGroupDTOMapper();
        $this->expectException('Error');
        $userGroupDTO = $mapper->toUserGroupDTO($userGroup);
    }

    public function testUserGroupDTOMapperHandlesEmptyUserGroupDTO()
    {
        $userGroupDTO = new UserGroupDTO();

        $mapper = new UserGroupDTOMapper();
        $this->expectException('Error');
        $userGroup = $mapper->toUserGroup($userGroupDTO);
    }
}
