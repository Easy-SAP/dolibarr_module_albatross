<?php

namespace Albatross\Tools;

require_once dirname(__DIR__) . '/models/index.php';
//require_once dirname(__DIR__) . '/mappers/index.php';

use Albatross\OrderDTO;
use Albatross\ProductDTO;
use Albatross\ServiceDTO;
use Albatross\ThirdpartyDTO;
use Albatross\TicketDTO;
use Albatross\UserDTO;
use Albatross\EntityDTO;

interface intDBManager
{
    public function createUser(UserDTO $userDTO): int;

    public function createCustomer(ThirdpartyDTO $thirdpartyDTO): int;

    public function createSupplier(ThirdpartyDTO $thirdpartyDTO): int;

    public function createProduct(ProductDTO $productDTO): int;

	public function createService(ServiceDTO $serviceDTO): int;

    public function createOrder(OrderDTO $orderDTO): int;

    public function createInvoice($invoice): int;

	public function createTicket(TicketDTO $ticketDTO): int;

    public function createEntity(EntityDTO $entityDTO): int;

	public function setupEntity(int $entityId = 0, array $params = []): bool;

    public function setSecurity(): bool;

    public function removeFixtures(): bool;
}
