<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/ProductDTO.class.php';
require_once dirname(__DIR__, 4) . '/product/class/product.class.php';

class ProductDTOMapper
{
    public function toProductDTO(\Product $product): ?ProductDTO
    {
        if(is_null($product->label)) {
            return null;
        }

        $productDTO = new ProductDTO();
        $productDTO
            ->setLabel($product->label)
            ->setTaxFreePrice($product->price ?? 0);

        return $productDTO;
    }

    public function toProduct(ProductDTO $productDTO): \Product
    {
        global $db;
        $product = new \Product($db);

        $product->ref = $productDTO->getLabel();
        $product->label = $productDTO->getLabel();
        $product->price = $productDTO->getTaxFreePrice();
        $product->status = 1;
        $product->status_buy = 1;

        return $product;
    }

    /**
     * @param ProductDTO|\ServiceDTO $productDTO
     * @return Product
     */
    public function toService($productDTO): \Product
    {
        global $db;
        $product = new \Product($db);
        $product->ref = $productDTO->getLabel();
        $product->label = $productDTO->getLabel();
        $product->price = $productDTO->getTaxFreePrice();
        $product->status = 1;
        $product->status_buy = 1;
        $product->type = \Product::TYPE_SERVICE;
        return $product;
    }
}
