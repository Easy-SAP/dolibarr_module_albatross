<?php

namespace Albatross\Tools;

//require_once dirname(__DIR__).'/models/index.php';

use Albatross\InvoiceDTO;
use Albatross\OrderDTO;
use Albatross\ProjectDTO;
use Albatross\ServiceDTO;
use Albatross\TaskDTO;
use Albatross\ThirdpartyDTO;
use Albatross\TicketDTO;
use Albatross\UserDTO;
use Albatross\UserGroupDTO;
use Albatross\ProductDTO;
use Albatross\EntityDTO;
use Albatross\Tools\intDBManager;

require_once __DIR__.'/intDBManager.php';

class dbManagerStub implements intDBManager
{
    public function createUser(UserDTO $userDTO): int
    {
        return 1;
    }

    public function createUserGroup(UserGroupDTO $userGroupDTO): int
    {
        return 1;
    }

    public function createCustomer(ThirdpartyDTO $thirdpartyDTO): int
    {
        return 1;
    }

    public function createSupplier(ThirdpartyDTO $thirdpartyDTO): int
    {
        return 1;
    }

    public function createProduct(ProductDTO $productDTO): int
    {
        return 1;
    }

    public function createService(ServiceDTO $serviceDTO): int
    {
        return 1;
    }

    public function createOrder(OrderDTO $orderDTO): int
    {
        return 1;
    }

    public function createInvoice(InvoiceDTO $invoice): int
    {
        return 1;
    }

    public function createTicket(TicketDTO $ticketDTO): int
    {
        return 1;
    }

    public function createEntity(EntityDTO $entityDTO): int
    {
        return 1;
    }

    public function createProject(ProjectDTO $projectDTO): int
    {
        return 1;
    }

    public function setupEntity(int $entityId = 0, array $params = []): bool
    {
        return true;
    }

    public function removeFixtures(): bool
    {
        return 1;
    }

	public function createTask(TaskDTO $taskDTO): int
	{
		return 1;
	}
}
