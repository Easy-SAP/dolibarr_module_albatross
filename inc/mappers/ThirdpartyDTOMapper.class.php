<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/ThirdpartyDTO.class.php';
require_once dirname(__DIR__, 4) . '/societe/class/societe.class.php';

class ThirdpartyDTOMapper
{
    public function toThirdpartyDTO(\Societe $thirdparty): ThirdpartyDTO
    {
        $thirdpartyDTO = new ThirdpartyDTO();
        $thirdpartyDTO
            ->setName($thirdparty->name ?? '')
            ->setAddress($thirdparty->address ?? '')
            ->setZipCode($thirdparty->zip ?? '')
            ->setCity($thirdparty->town ?? '')
            ->setEmail($thirdparty->email ?? '')
            ->setPhone($thirdparty->phone ?? '')
            ->setSiret($thirdparty->idprof2 ?? '')
            ->setVatUsed($thirdparty->tva_assuj ?? 1);

        return $thirdpartyDTO;
    }

    public function toSupplier(ThirdpartyDTO $thirdpartyDTO): \Societe
    {
        global $conf, $db;

        $thirdparty = new \Societe($db);

        $thirdparty->name = $thirdpartyDTO->getName();
        $thirdparty->address = $thirdpartyDTO->getAddress();
        $thirdparty->zip = $thirdpartyDTO->getZipCode();
        $thirdparty->town = $thirdpartyDTO->getCity();
        $thirdparty->email = $thirdpartyDTO->getEmail();
        $thirdparty->phone = $thirdpartyDTO->getPhone();
        $thirdparty->idprof2 = $thirdpartyDTO->getSiret();
        $thirdparty->tva_assuj = $thirdpartyDTO->isVatUsed() ? 1 : 0;
        $thirdparty->entity = $conf->entity;

        $thirdparty->country_id = 1;
        $thirdparty->client = 0;
        $thirdparty->code_fournisseur = 'auto';
        $thirdparty->fournisseur = 1;
        $thirdparty->array_options['options_fraisservice_entity'] = $thirdpartyDTO->getEntity();

        // TODO: Add Bank accounts

        return $thirdparty;
    }

    public function toCustomer(ThirdpartyDTO $thirdpartyDTO): \Societe
    {
        global $conf, $db;

        $thirdparty = new \Societe($db);

        $thirdparty->name = $thirdpartyDTO->getName();
        $thirdparty->address = $thirdpartyDTO->getAddress();
        $thirdparty->zip = $thirdpartyDTO->getZipCode();
        $thirdparty->town = $thirdpartyDTO->getCity();
        $thirdparty->email = $thirdpartyDTO->getEmail();
        $thirdparty->phone = $thirdpartyDTO->getPhone();
        $thirdparty->idprof2 = $thirdpartyDTO->getSiret();
        $thirdparty->tva_assuj = $thirdpartyDTO->isVatUsed() ? 1 : 0;

        $thirdparty->country_id = 1;
        $thirdparty->client = 1;
        $thirdparty->code_client = 'auto';
        $thirdparty->fournisseur = 0;
        $thirdparty->entity = $conf->entity;

        return $thirdparty;
    }
}
