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
        return $ticketDTO;
    }
}
