<?php

namespace test\functional;

define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__, 2).'/inc/mappers/ProductDTOMapper.class.php';

use PHPUnit\Framework\TestCase;

class ProductMapperTest extends TestCase
{
    public function testProductDTOMapperConvertsToProductDTO()
    {
        global $db;
        $product = new \Product($db);
        $product->label = 'Test Product';
        $product->price = 100.0;

        $mapper = new \Albatross\ProductDTOMapper();
        $productDTO = $mapper->toProductDTO($product);

        $this->assertEquals('Test Product', $productDTO->getLabel());
        $this->assertEquals(100.0, $productDTO->getTaxFreePrice());
    }

    public function testProductDTOMapperConvertsToProduct()
    {
        global $db;
        $productDTO = new \Albatross\ProductDTO();
        $productDTO->setLabel('Test Product');
        $productDTO->setTaxFreePrice(100.0);

        $mapper = new \Albatross\ProductDTOMapper();
        $product = $mapper->toProduct($productDTO);

        $this->assertEquals('Test Product', $product->label);
        $this->assertEquals(100.0, $product->price);
    }

    public function testProductDTOMapperHandlesEmptyProduct()
    {
        global $db;
        $product = new \Product($db);
        $product->label = null;
        $product->price = null;

        $mapper = new \Albatross\ProductDTOMapper();
        $productDTO = $mapper->toProductDTO($product);

        $this->assertNull($productDTO);
    }

    public function testProductDTOMapperConvertsToService()
    {
        global $db;
        $productDTO = new \Albatross\ProductDTO();
        $productDTO->setLabel('Test Service');
        $productDTO->setTaxFreePrice(200.0);

        $mapper = new \Albatross\ProductDTOMapper();
        $service = $mapper->toService($productDTO);

        $this->assertEquals('Test Service', $service->label);
        $this->assertEquals(200.0, $service->price);
        $this->assertEquals(\Product::TYPE_SERVICE, $service->type);
    }
}
