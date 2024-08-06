<?php

include_once dirname( __DIR__) .'/models/UserGroupDTO.class.php';

use Albatross\UserGroupDTO;

require_once dirname(__DIR__,4) . '/user/class/usergroup.class.php';

class UserGroupDTOMapper
{
    public function toUserDTO(\UserGroup $userGroup): UserGroupDTO
    {
        $userGroupDTO = new UserGroupDTO();
        $userGroupDTO
            ->setId($userGroup->id)
            ->setLabel($userGroup->name);

        return $userGroupDTO;
    }

    public function toUserGroup(UserGroupDTO $userGroupDTO): UserGroup
    {
        global $db;
        $newUserGroup = new UserGroup($db);

        $newUserGroup->id = $userGroupDTO->getId();
        $newUserGroup->name = $userGroupDTO->getLabel();

        return $newUserGroup;
    }
}
