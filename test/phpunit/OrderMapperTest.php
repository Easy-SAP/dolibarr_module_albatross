<?php

namespace test\functional;

// Prepare the environment
if(!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__).'/_setup.php';
}

require_once dirname(__DIR__, 2).'/inc/mappers/OrderDTOMapper.class.php';


use Albatross\OrderDTO;
use Albatross\OrderDTOMapper;
use Albatross\OrderLineDTO;
use Commande;
use DateTime;
use PHPUnit\Framework\TestCase;

class OrderMapperTest extends TestCase
{
    public function testOrderDTOMapperConvertsToOrderDTO()
    {
        global $db;
        $order = new Commande($db);
        $order->lines = [
            (object)['qty' => 10, 'product' => (object) ['id' => 1]],
            (object)['qty' => 5, 'product' => (object) ['id' => 2]]
        ];
        $order->ref_customer = 100;
        $order->socid = 200;
        $order->date = time();

        $mapper = new OrderDTOMapper();
        $orderDTO = $mapper->toOrderDTO($order);

        $this->assertEquals(100, $orderDTO->getCustomerId());
        $this->assertEquals(200, $orderDTO->getSupplierId());
        $this->assertEquals((new DateTime())->setTimestamp($order->date), $orderDTO->getDate());

        // Line 1
        $this->assertEquals(10, $orderDTO->getOrderLines()[0]->getQuantity());
        $this->assertEquals(1, $orderDTO->getOrderLines()[0]->getProductId());
        // Line 2
        $this->assertEquals(5, $orderDTO->getOrderLines()[1]->getQuantity());
        $this->assertEquals(2, $orderDTO->getOrderLines()[1]->getProductId());
    }

    public function testOrderDTOMapperConvertsToOrder()
    {
        $date = new DateTime();
        $orderDTO = new OrderDTO();
        $orderDTO
            ->setCustomerId(100)
            ->setSupplierId(200)
            ->setDate($date);

        $orderLineDTO1 = new OrderLineDTO();
        $orderLineDTO1
            ->setQuantity(10)
            ->setProductId(1)
            ->setDescription('Desc')
            ->setUnitprice(12.5);

        $orderLineDTO2 = new OrderLineDTO();
        $orderLineDTO2
            ->setQuantity(5)
            ->setProductId(2)
            ->setDescription('Desc')
            ->setUnitprice(12.5)
            ->setDiscount(10);

        $orderDTO
            ->addOrderLine($orderLineDTO1)
            ->addOrderLine($orderLineDTO2);

        $mapper = new OrderDTOMapper();
        $order = $mapper->toOrder($orderDTO);

        $this->assertEquals(100, $order->ref_customer);
        $this->assertEquals(200, $order->socid);
        $this->assertEquals($date->getTimestamp(), $order->date);

        // Line 1
        $this->assertEquals(1, $order->lines[0]->fk_product);
        $this->assertEquals('Desc', $order->lines[0]->desc);
        $this->assertEquals(12.500, $order->lines[0]->subprice);
        $this->assertEquals(10, $order->lines[0]->qty);
        $this->assertEquals(0, $order->lines[0]->remise_percent);
        // Line 2
        $this->assertEquals(2, $order->lines[1]->fk_product);
        $this->assertEquals('Desc', $order->lines[1]->desc);
        $this->assertEquals(12.500, $order->lines[1]->subprice);
        $this->assertEquals(5, $order->lines[1]->qty);
        $this->assertEquals(10, $order->lines[1]->remise_percent);

    }

    public function testOrderDTOMapperHandlesNullOrder()
    {
        global $db;
        $order = new Commande($db);
        $order->lines = null;
        $order->ref_customer = null;
        $order->socid = null;
        $order->date = null;

        $mapper = new OrderDTOMapper();
        $orderDTO = $mapper->toOrderDTO($order);

        $this->assertEquals(0, $orderDTO->getCustomerId());
        $this->assertEquals(0, $orderDTO->getSupplierId());
        $this->assertEmpty($orderDTO->getOrderLines());
        //$this->assertNull($orderDTO->getDate());
    }

    /**
     * An object can be translated first with partial data and filled later so we have to handle null values
     * @return void
     */
    public function testOrderDTOMapperHandlesNullOrderDTO()
    {
        $date = new DateTime();
        $orderDTO = new OrderDTO();

        $mapper = new OrderDTOMapper();
        $order = $mapper->toOrder($orderDTO);

        $this->assertEquals(0, $order->ref_customer);
        $this->assertEquals(0, $order->socid);
        $this->assertEquals($date->getTimestamp(), $order->date);
        $this->assertEmpty($order->lines);
    }

    public function testOrderDTOMapperHandlesInvalidOrderLine()
    {
        global $db;
        $order = new Commande($db);
        $order->lines = [(object)['qty' => null, 'product' => null]];
        $order->ref_customer = 100;
        $order->socid = 200;
        $order->date = time();

        $mapper = new OrderDTOMapper();
        $orderDTO = $mapper->toOrderDTO($order);

        $this->assertEquals(100, $orderDTO->getCustomerId());
        $this->assertEquals(200, $orderDTO->getSupplierId());
        $this->assertEquals((new DateTime())->setTimestamp($order->date), $orderDTO->getDate());

        $this->assertEquals(0, $orderDTO->getOrderLines()[0]->getUnitprice());
        $this->assertEquals(1, $orderDTO->getOrderLines()[0]->getQuantity());
        $this->assertNull($orderDTO->getOrderLines()[0]->getProductId());
        $this->assertEquals(0, $orderDTO->getOrderLines()[0]->getDiscount());
        $this->assertEquals('', $orderDTO->getOrderLines()[0]->getDescription());
    }
}
