<?php

namespace test\functional;

define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__, 2).'/inc/mappers/TicketDTOMapper.class.php';

use PHPUnit\Framework\TestCase;

class TicketMapperTest extends TestCase
{
    public function testTicketDTOMapperConvertsToTicketDTO()
    {
        global $db;
        $ticket = new \Ticket($db);
        $ticket->subject = 'Test Subject';
        $ticket->description = 'Test Description';
        $ticket->datec = time();

        $mapper = new \Albatross\TicketDTOMapper();
        $ticketDTO = $mapper->toTicketDTO($ticket);

        $this->assertEquals('Test Subject', $ticketDTO->getSubject());
        $this->assertEquals('Test Description', $ticketDTO->getDescription());
        $this->assertEquals((new \DateTime())->setTimestamp($ticket->datec), $ticketDTO->getCreationDate());
    }

    public function testTicketDTOMapperHandlesEmptyTicket()
    {
        global $db;
        $ticket = new \Ticket($db);

        $mapper = new \Albatross\TicketDTOMapper();

        $this->expectException(\Exception::class);
        $ticketDTO = $mapper->toTicketDTO($ticket);
    }
}
