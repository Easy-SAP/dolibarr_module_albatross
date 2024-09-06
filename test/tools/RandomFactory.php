<?php

require_once dirname(__DIR__, 2).'/inc/models/index.php';

use Albatross\InvoiceLineDTO;
use Albatross\OrderLineDTO;
use Albatross\ProjectDTO;
use Albatross\UserDTO;
use Albatross\UserGroupDTO;
use Albatross\ThirdpartyDTO;
use Albatross\ProductDTO;
use Albatross\ServiceDTO;
use Albatross\OrderDTO;
use Albatross\InvoiceDTO;
use Albatross\TicketDTO;
use Albatross\EntityDTO;

class RandomFactory
{
    public static function getRandomUser(): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->setFirstname('John');
        $userDTO->setLastname('Doe');
        $userDTO->setEmail('john.doe@example.com');
        $userDTO->setPhone('1234567890');
        $userDTO->setAddress('123 Main St');
        $userDTO->setZipCode('12345');
        $userDTO->setCity('Test City');

        return $userDTO;
    }

    public static function getRandomUserGroup()
    {
        $userGroupDTO = new UserGroupDTO();
        $userGroupDTO
			->setLabel('Admin');

        return $userGroupDTO;
    }

    public static function getRandomCustomer(): ThirdpartyDTO
    {
        $customerDTO = new ThirdpartyDTO();
        $customerDTO->setName('Test Customer');
        $customerDTO->setAddress('456 Customer St');
        $customerDTO->setZipCode('67890');
        $customerDTO->setCity('Customer City');
        $customerDTO->setPhone('0987654321');
        $customerDTO->setEmail('customer@example.com');

        return $customerDTO;
    }

    public static function getRandomSupplier(): ThirdpartyDTO
    {
        $supplierDTO = new ThirdpartyDTO();
        $supplierDTO->setName('Test Supplier');
        $supplierDTO->setAddress('789 Supplier St');
        $supplierDTO->setZipCode('54321');
        $supplierDTO->setCity('Supplier City');
        $supplierDTO->setPhone('1122334455');
        $supplierDTO->setEmail('supplier@example.com');

        return $supplierDTO;
    }

    public static function getRandomProduct(): ProductDTO
    {
        $productDTO = new ProductDTO();
        $productDTO->setLabel('Test Product');
        $productDTO->setTaxFreePrice(100.0);

        return $productDTO;
    }

    public static function getRandomService(): ServiceDTO
    {
        $serviceDTO = new ServiceDTO();
        $serviceDTO->setLabel('Test Service');
        $serviceDTO->setTaxFreePrice(100.0);

        return $serviceDTO;
    }

    public static function getRandomOrder(): OrderDTO
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

        return $orderDTO;
    }

    public static function getRandomInvoice(): InvoiceDTO
    {
        $date = new DateTime();
        $invoiceDTO = new InvoiceDTO();
        $invoiceDTO
            ->setCustomerId(100)
            ->setSupplierId(200)
            ->setDate($date);

        $invoiceLineDTO1 = new InvoiceLineDTO();
        $invoiceLineDTO1
            ->setQuantity(10)
            ->setProductId(1)
            ->setDescription('Desc')
            ->setUnitprice(12.5);

        $invoiceLineDTO2 = new InvoiceLineDTO();
        $invoiceLineDTO2
            ->setQuantity(5)
            ->setProductId(2)
            ->setDescription('Desc')
            ->setUnitprice(12.5)
            ->setDiscount(10);

        $invoiceDTO
            ->addInvoiceLine($invoiceLineDTO1)
            ->addInvoiceLine($invoiceLineDTO2);

        return $invoiceDTO;
    }

    public static function getRandomProject(): ProjectDTO
    {
        $projectDTO = new ProjectDTO();
        $projectDTO
            ->setLabel('Test Project');

        return $projectDTO;
    }

    public static function getRandomTicket(): TicketDTO
    {
        $ticketDTO = new TicketDTO();
        $ticketDTO->setSubject('Test Ticket');
        $ticketDTO->setDescription('This is a test ticket');
        $ticketDTO->setCreationDate(new DateTime());

        return $ticketDTO;
    }

    public static function getRandomEntity(): EntityDTO
    {
        $entityDTO = new EntityDTO();
        $entityDTO
            ->setName('Test Entity');

        return $entityDTO;
    }
}
