<?php

namespace test\functional;
define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__,2).'/inc/mappers/OrderDTOMapper.class.php';


use PHPUnit\Framework\TestCase;

class OrderMapperTest extends TestCase
{
	public function testOrderDTOMapperHandlesMultipleOrderLines()
	{
		global $db;
		$order = new \Commande($db);
		$order->lines = [
			(object)['qty' => 10, 'product' => 1],
			(object)['qty' => 5, 'product' => 2]
		];
		$order->ref_customer = 100;
		$order->socid = 200;
		$order->date = time();

		$mapper = new \Albatross\OrderDTOMapper();
		$orderDTO = $mapper->toOrderDTO($order);

		$this->assertEquals(10, $orderDTO->getQuantity());
		$this->assertEquals(1, $orderDTO->getProductId());
		$this->assertEquals(100, $orderDTO->getCustomerId());
		$this->assertEquals(200, $orderDTO->getSupplierId());
		$this->assertEquals((new \DateTime())->setTimestamp($order->date), $orderDTO->getDate());
	}

	public function testOrderDTOMapperHandlesNullOrder()
	{
		$order = new \Commande();
		$order->lines = null;
		$order->ref_customer = null;
		$order->socid = null;
		$order->date = null;

		$mapper = new \Albatross\OrderDTOMapper();
		$orderDTO = $mapper->toOrderDTO($order);

		$this->assertEquals(0, $orderDTO->getQuantity());
		$this->assertEquals(0, $orderDTO->getProductId());
		$this->assertEquals(0, $orderDTO->getCustomerId());
		$this->assertEquals(0, $orderDTO->getSupplierId());
		$this->assertNull($orderDTO->getDate());
	}

	public function testOrderDTOMapperHandlesInvalidOrderLine()
	{
		$order = new \Commande();
		$order->lines = [(object)['qty' => 'invalid', 'product' => 'invalid']];
		$order->ref_customer = 100;
		$order->socid = 200;
		$order->date = time();

		$mapper = new \Albatross\OrderDTOMapper();
		$orderDTO = $mapper->toOrderDTO($order);

		$this->assertEquals(0, $orderDTO->getQuantity());
		$this->assertEquals(0, $orderDTO->getProductId());
		$this->assertEquals(100, $orderDTO->getCustomerId());
		$this->assertEquals(200, $orderDTO->getSupplierId());
		$this->assertEquals((new \DateTime())->setTimestamp($order->date), $orderDTO->getDate());
	}
}
