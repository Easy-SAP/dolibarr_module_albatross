<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/EntityDTO.class.php';
require_once dirname(__DIR__, 4) . '/custom/multicompany/class/dao_multicompany.class.php';

class Entity extends \DaoMulticompany
{
}

class EntityDTOMapper
{
    public function toEntityDTO(\DaoMulticompany $entity): ?EntityDTO
    {
        $requiredNotNull = ['label', 'name', 'usetemplate', 'address', 'zipcode', 'city'];
        foreach($requiredNotNull as $field) {
            if(is_null($entity->$field)) {
                throw new \Exception("Field $field is required and cannot be null");
            }
        }

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

    public function toEntity(EntityDTO $entityDTO): \DaoMulticompany
    {
        global $db;
        $entity = new \DaoMulticompany($db);

        $requiredNotNull = ['name'];
        foreach($requiredNotNull as $field) {
            $methodName = 'get' . ucfirst($field);
            if(is_null($entityDTO->$methodName()) || empty($entityDTO->$methodName())) {
                throw new \Exception("Field $field is required and cannot be null");
            }
        }

        $entity->name = $entityDTO->getName();
        $entity->label = $entityDTO->getLabel() ?? $entityDTO->getName();
        $entity->usetemplate = $entityDTO->getModel();
        $entity->address = $entityDTO->getAddress();
        $entity->zipcode = $entityDTO->getZipCode();
        $entity->town = $entityDTO->getCity();

        $entity->country_id = 1;
        $entity->currency_code = 'EUR';
        $entity->main_lang_default = 'auto';

        $_POST['name'] = $entityDTO->getName();
        $_POST['label'] = $entityDTO->getLabel() ?? $entityDTO->getName();
        $_POST['template'] = 0;
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

    public function toModel(EntityDTO $entityDTO): \DaoMulticompany
    {
        global $db;
        $entity = $this->toEntity($entityDTO);
        $_POST['template'] = 1;
        $_POST['usetemplate'] = 0;

        return $entity;
    }
}
