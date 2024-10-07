<?php

namespace Albatross\Tools;

require_once dirname(__DIR__) . '/models/index.php';
//require_once dirname(__DIR__) . '/mappers/index.php';

use Albatross\InvoiceDTO;
use Albatross\OrderDTO;
use Albatross\ProductDTO;
use Albatross\ProjectDTO;
use Albatross\ServiceDTO;
use Albatross\ThirdpartyDTO;
use Albatross\TicketDTO;
use Albatross\UserDTO;
use Albatross\EntityDTO;
use Albatross\UserGroupDTO;
use Albatross\TaskDTO;

interface intDBManager
{
    public function createUser(UserDTO $userDTO): int;

    public function createUserGroup(UserGroupDTO $userGroupDTO): int;

    public function createCustomer(ThirdpartyDTO $thirdpartyDTO): int;

    public function createSupplier(ThirdpartyDTO $thirdpartyDTO): int;

    public function createProduct(ProductDTO $productDTO): int;

    public function createService(ServiceDTO $serviceDTO): int;

    public function createOrder(OrderDTO $orderDTO): int;

    public function createInvoice(InvoiceDTO $invoice): int;

    public function createTicket(TicketDTO $ticketDTO): int;

    public function createProject(ProjectDTO $projectDTO): int;

    public function createEntity(EntityDTO $entityDTO): int;

    public function setupEntity(int $entityId = 0, array $params = []): bool;

	public function createTask(TaskDTO $taskDTO): int;

    public function removeFixtures(): bool;
}
