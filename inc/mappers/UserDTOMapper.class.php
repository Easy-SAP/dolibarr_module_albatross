<?php

//include_once dirname( __DIR__) .'/models/UserDTO.class.php';
namespace albatross\inc\mappers;

use User;
use UserDTO;

require_once DOL_DOCUMENT_ROOT . '/user/class/user.class.php';

class UserDTOMapper
{
    public function toUserDTO(User $user): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO
            ->setFirstname($user->firstname)
            ->setLastname($user->lastname)
            ->setEmail($user->email)
            ->setPhone($user->office_phone)
            ->setAddress($user->address)
            ->setZipCode($user->zip)
            ->setCity($user->town);

        return $userDTO;
    }

    public function toUser(UserDTO $userDTO): User
    {
        global $db;
        $user = new User($db);

        $user->login = $userDTO->getFirstname();
        $user->firstname = $userDTO->getFirstname();
        $user->lastname = $userDTO->getLastname();
        $user->email = $userDTO->getEmail();
        $user->office_phone = $userDTO->getPhone();
        $user->address = $userDTO->getAddress();
        $user->zip = $userDTO->getZipCode();
        $user->town = $userDTO->getCity();

        return $user;
    }
}
