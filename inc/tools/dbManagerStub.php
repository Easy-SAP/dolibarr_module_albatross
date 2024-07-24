<?php

namespace Albatross\Tools;

//require_once dirname(__DIR__).'/models/index.php';

use Albatross\OrderDTO;
use Albatross\ThirdpartyDTO;
use Albatross\UserDTO;
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

	public function createOrder(OrderDTO $orderDTO): int
	{
		return 1;
	}

	public function createInvoice($invoice): int
	{
		return 1;
	}

    public function createEntity(EntityDTO $entityDTO): int
    {
        return 1;
    }


	public function setSecurity(): bool
	{
		return 1;
	}

    public function removeFixtures(): bool
    {
        return 1;
    }
}
