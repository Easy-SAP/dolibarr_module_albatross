<?php

namespace test\functional;

use PHPUnit\Framework\TestCase;

class IsolationTest extends TestCase
{
    public function testDTOIsolation()
    {

        $this->assertFileExists(dirname(__DIR__, 2).'/inc/models/index.php');
        require_once dirname(__DIR__, 2).'/inc/models/index.php';

        $this->assertThat(
            class_exists('Albatross\EntityDTO'),
            $this->isTrue(),
            'Class EntityDTO does not exist'
        );

        $entityDTO = new \Albatross\EntityDTO();

        $this->assertThat(
            class_exists('Albatross\OrderDTO'),
            $this->isTrue(),
            'Class OrderDTO does not exist'
        );

        $orderDTO = new \Albatross\OrderDTO();

        $this->assertThat(
            class_exists('Albatross\ProductDTO'),
            $this->isTrue(),
            'Class ProductDTO does not exist'
        );

        $productDTO = new \Albatross\ProductDTO();

        $this->assertThat(
            class_exists('Albatross\ServiceDTO'),
            $this->isTrue(),
            'Class ServiceDTO does not exist'
        );

        $serviceDTO = new \Albatross\ServiceDTO();

        $this->assertThat(
            class_exists('Albatross\ThirdpartyDTO'),
            $this->isTrue(),
            'Class ThirdpartyDTO does not exist'
        );

        $thirdpartyDTO = new \Albatross\ThirdpartyDTO();

        $this->assertThat(
            class_exists('Albatross\TicketDTO'),
            $this->isTrue(),
            'Class TicketDTO does not exist'
        );

        $ticketDTO = new \Albatross\TicketDTO();

        $this->assertThat(
            class_exists('Albatross\UserDTO'),
            $this->isTrue(),
            'Class UserDTO does not exist'
        );

        $userDTO = new \Albatross\UserDTO();
    }

    public function testMappersIsolation()
    {
        $this->assertFileExists(dirname(__DIR__, 2).'/inc/mappers/index.php');
        define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));

        require_once dirname(__DIR__, 2).'/inc/mappers/index.php';

        $this->assertThat(
            class_exists('Albatross\EntityDTOMapper'),
            $this->isTrue(),
            'Class EntityDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\OrderDTOMapper'),
            $this->isTrue(),
            'Class OrderDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\ProductDTOMapper'),
            $this->isTrue(),
            'Class ProductDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\ServiceDTOMapper'),
            $this->isFalse(),
            'Class ServiceDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\ThirdpartyDTOMapper'),
            $this->isTrue(),
            'Class ThirdpartyDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\TicketDTOMapper'),
            $this->isTrue(),
            'Class TicketDTOMapper does not exist'
        );

        $this->assertThat(
            class_exists('Albatross\UserDTOMapper'),
            $this->isTrue(),
            'Class UserDTOMapper does not exist'
        );
    }

    public function testToolsIsolation()
    {
        $this->assertFileExists(dirname(__DIR__, 2).'/inc/tools/dbManagerStub.php');
        $this->assertFileExists(dirname(__DIR__, 2).'/inc/tools/doliDBManager.php');
        $this->assertFileExists(dirname(__DIR__, 2).'/inc/tools/intDBManager.php');
        if(!defined('DOL_DOCUMENT_ROOT')) {
            define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
        }

        require_once dirname(__DIR__, 2).'/inc/tools/intDBManager.php';

        $this->assertThat(
            interface_exists('Albatross\Tools\intDBManager'),
            $this->isTrue(),
            'Class intDBManager does not exist'
        );

        // This test will fail because multicompany module is not isolated
        // and business logic is not separated from the database layer
        require_once dirname(__DIR__, 2).'/inc/tools/doliDBManager.php';

        $this->assertThat(
            class_exists('Albatross\Tools\DoliDBManager'),
            $this->isTrue(),
            'Class DoliDBManager does not exist'
        );

        require_once dirname(__DIR__, 2).'/inc/tools/dbManagerStub.php';

        $this->assertThat(
            class_exists('Albatross\Tools\dbManagerStub'),
            $this->isTrue(),
            'Class dbManagerStub does not exist'
        );
    }
}
