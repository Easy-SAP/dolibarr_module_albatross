<?php

//include_once dirname( __DIR__) .'/models/ProductDTO.class.php';
namespace Albatross;

use Product;
use Albatross\ProductDTO;

require_once DOL_DOCUMENT_ROOT . '/product/class/product.class.php';

class ProductDTOMapper
{
    public function toProductDTO(Product $product): ProductDTO
    {
        $productDTO = new ProductDTO();
        $productDTO
            ->setLabel($product->label)
			->setTaxFreePrice($product->price ?? 0);

        return $productDTO;
    }

    public function toProduct(ProductDTO $productDTO): Product
    {
        global $db;
        $product = new Product($db);

		$product->ref = $productDTO->getLabel();
		$product->label = $productDTO->getLabel();
		$product->price = $productDTO->getTaxFreePrice();
		$product->status = 1;
		$product->status_buy = 1;

        return $product;
    }
}
