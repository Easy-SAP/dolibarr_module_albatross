<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/TicketDTO.class.php';
require_once dirname(__DIR__,4) . '/ticket/class/cticketcategory.class.php';

use \Ticket;
use Albatross\TicketDTO;

class TicketDTOMapper
{
    public function toTicketDTO(Ticket $ticket): TicketDTO
    {
        $ticketDTO = new TicketDTO();
        $ticketDTO
            ->setEntityName($ticket->array_options['options_entity_name'] ?? '')
            ->setEntitySiret($ticket->array_options['options_entity_siret'] ?? '')
            ->setEntityModel($ticket->array_options['options_entity_template'] ?? -1)
            ->setUserFirstname($ticket->array_options['options_user_lastname'])
            ->setUserLastname($ticket->array_options['options_user_firstname'] ?? '')
            ->setUserPhone($ticket->array_options['options_user_phone'] ?? '')
            ->setUserEmail($ticket->array_options['options_user_email'])
            ->setUserAddress($ticket->array_options['options_thirdparty_address'] ?? '')
            ->setUserZipCode($ticket->array_options['options_thirdparty_zipcode'] ?? 0)
            ->setUserCity($ticket->array_options['options_thirdparty_town'] ?? '')
            ->setEntitySponsor($ticket->array_options['options_user_sponsor'] ?? 0);

        return $ticketDTO;
    }
}
