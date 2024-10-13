<?php

namespace test\functional;

// Prepare the environment
if (!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__) . '/_setup.php';
}

require_once dirname(__DIR__, 2) . '/inc/mappers/TicketDTOMapper.class.php';

use Albatross\TicketDTOMapper;
use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Ticket;

class TicketMapperTest extends TestCase
{
    public function testTicketDTOMapperConvertsToTicketDTO()
    {
        global $db;
        $ticket = new Ticket($db);
        $ticket->subject = 'Test Subject';
        $ticket->description = 'Test Description';
        $ticket->datec = time();

        $mapper = new TicketDTOMapper();
        $ticketDTO = $mapper->toTicketDTO($ticket);

        $this->assertEquals('Test Subject', $ticketDTO->getSubject());
        $this->assertEquals('Test Description', $ticketDTO->getDescription());
        $this->assertEquals((new DateTime())->setTimestamp($ticket->datec), $ticketDTO->getCreationDate());
    }

    public function testTicketDTOMapperHandlesEmptyTicket()
    {
        global $db;
        $ticket = new Ticket($db);

        $mapper = new TicketDTOMapper();

        $this->expectException(Exception::class);
        $ticketDTO = $mapper->toTicketDTO($ticket);
    }
}
