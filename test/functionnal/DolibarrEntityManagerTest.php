<?php

// Prepare the environment
const ROOT = '/var/www/html';
const NOLOGIN = true;
require_once ROOT.'/main.inc.php';
require_once ROOT . '/core/lib/admin.lib.php';

require_once ROOT . '/custom/albatross/inc/models/index.php';

// Require tested class
const MODULE_ROOT = ROOT . '/custom/albatross';
require_once MODULE_ROOT . '/inc/tools/DoliDBManager.php';

require_once MODULE_ROOT . '/test/tools/RandomFactory.php';


use Albatross\Tools\DoliDBManager;
use PHPUnit\Framework\TestCase;

class DolibarrEntityManagerTest extends TestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = new DoliDBManager();
        $this->entityManager->removeFixtures();
    }

    public function testCreateUser()
    {
        $userDTO = RandomFactory::getRandomUser();

        $userID = $this->entityManager->createUser($userDTO);

        $this->assertGreaterThan(0, $userID);
    }

    public function testCreateUserGroup()
    {
        $userGroupDTO = RandomFactory::getRandomUserGroup();
        $groupID = $this->entityManager->createUserGroup($userGroupDTO);

        $this->assertGreaterThan(0, $groupID);
    }

    public function testCreateCustomer()
    {
        $customerDTO = RandomFactory::getRandomCustomer();
        $customerID = $this->entityManager->createCustomer($customerDTO);
        $this->assertGreaterThan(0, $customerID);
    }

    public function testCreateSupplier()
    {
        $supplierDTO = RandomFactory::getRandomSupplier();
        $supplierID = $this->entityManager->createSupplier($supplierDTO);
        $this->assertGreaterThan(0, $supplierID);
    }

    public function testCreateProduct()
    {
        $productDTO = RandomFactory::getRandomProduct();
        $productID = $this->entityManager->createProduct($productDTO);
        $this->assertGreaterThan(0, $productID);
    }

    public function testCreateService()
    {
        $serviceDTO = RandomFactory::getRandomService();
        $serviceID = $this->entityManager->createService($serviceDTO);
        $this->assertGreaterThan(0, $serviceID);
    }

    public function testCreateOrder()
    {
        $orderDTO = RandomFactory::getRandomOrder();
        $orderID = $this->entityManager->createOrder($orderDTO);
        $this->assertGreaterThan(0, $orderID);
    }

    public function testCreateInvoice()
    {
        $invoiceDTO = RandomFactory::getRandomInvoice();
        $invoiceID = $this->entityManager->createInvoice($invoiceDTO);
        $this->assertGreaterThan(0, $invoiceID);
    }

    public function testCreateTicket()
    {
        $ticketDTO = RandomFactory::getRandomTicket();
        $ticketID = $this->entityManager->createTicket($ticketDTO);
        $this->assertGreaterThan(0, $ticketID);
    }

    public function testCreateEntity()
    {
        $entityDTO = RandomFactory::getRandomEntity();
        $entityID = $this->entityManager->createEntity($entityDTO);
        $this->assertGreaterThan(0, $entityID);
    }
}
