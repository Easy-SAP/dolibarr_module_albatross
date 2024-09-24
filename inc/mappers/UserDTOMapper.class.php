<?php

namespace Albatross;

include_once dirname(__DIR__) .'/models/UserDTO.class.php';

use User;
use Albatross\UserDTO;

require_once dirname(__DIR__, 4) . '/user/class/user.class.php';

class UserDTOMapper
{
    public function toUserDTO(User $newUser): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO
            ->setFirstname($newUser->firstname ?? '')
            ->setLastname($newUser->lastname ?? '')
            ->setEmail($newUser->email ?? '')
            ->setPhone($newUser->office_phone ?? '')
            ->setAddress($newUser->address ?? '')
            ->setZipCode($newUser->zip ?? '')
            ->setCity($newUser->town ?? '');

        return $userDTO;
    }

    public function toUser(UserDTO $userDTO): User
    {
        global $db;
        $newUser = new User($db);

        $newUser->login = $userDTO->getFirstname();
        $newUser->firstname = $userDTO->getFirstname();
        $newUser->lastname = $userDTO->getLastname();
        $newUser->email = $userDTO->getEmail();
        $newUser->office_phone = $userDTO->getPhone();
        $newUser->address = $userDTO->getAddress();
        $newUser->zip = $userDTO->getZipCode();
        $newUser->town = $userDTO->getCity();

        foreach ($userDTO->getGroups() ?? [] as $userGroupDTO) {
            $newUser->user_group_list[] = $userGroupDTO->getId();
        }

        $newUser->entity = 1;

        return $newUser;
    }
}
