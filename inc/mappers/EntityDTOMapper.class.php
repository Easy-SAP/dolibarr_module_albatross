<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/EntityDTO.class.php';
require_once DOL_DOCUMENT_ROOT . '/custom/multicompany/class/dao_multicompany.class.php';

class Entity extends DaoMulticompany
{
}

class EntityDTOMapper
{
    public function toEntityDTO(\Entity $entity): EntityDTO
    {
        $entityDTO = new EntityDTO();
        $entityDTO
            ->setLabel($entity->label)
            ->setName($entity->name)
            ->setModel($entity->usetemplate)
            ->setAddress($entity->address)
            ->setZipCode($entity->zipcode)
            ->setCity($entity->city);

        return $entityDTO;
    }

    public function toEntity(EntityDTO $entityDTO): \Entity
    {
        global $db;
        $entity = new \Entity($db);

        $entity->name = $entityDTO->getName();
        $entity->label = $entityDTO->getLabel();
        $entity->usetemplate = $entityDTO->getModel();
        $entity->address = $entityDTO->getAddress();
        $entity->zipcode = $entityDTO->getZipCode();
        $entity->town = $entityDTO->getCity();

        $entity->country_id = 1;
        $entity->currency_code = 'EUR';
        $entity->main_lang_default = 'auto';

        $_POST['name'] = $entityDTO->getName();
        $_POST['label'] = $entityDTO->getLabel();
        $_POST['usetemplate'] = $entityDTO->getModel();
        $_POST['address'] = $entityDTO->getAddress();
        $_POST['zipcode'] = $entityDTO->getZipCode();
        $_POST['town'] = $entityDTO->getCity();

        $_POST['country_id'] = 1;
        $_POST['currency_code'] = 'EUR';
        $_POST['main_lang_default'] = 'auto';

        $_POST['options_fraisservice_parrain'] = $entityDTO->getSponsorId();

        return $entity;
    }
}
