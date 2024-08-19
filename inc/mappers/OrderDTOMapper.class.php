<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/ProductDTO.class.php';
include_once dirname(__DIR__) . '/models/OrderDTO.class.php';
require_once dirname(__DIR__, 4) . '/commande/class/commande.class.php';
require_once dirname(__DIR__, 4) . '/product/class/product.class.php';

class OrderDTOMapper
{
    public function toOrderDTO(\Commande $order): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO
            ->setQuantity($order->lines[0]->qty)
            ->setProductId($order->lines[0]->product ?? 0)
            ->setCustomerId($order->ref_customer ?? 0)
            ->setSupplierId($order->socid ?? 0)
            ->setDate((new \DateTime())->setTimestamp($order->date));

        return $orderDTO;
    }

    public function toOrder(OrderDTO $orderDTO): \Commande
    {
        global $db, $user;
        $order = new \Commande($db);
        $orderLine = new OrderLine($db);

        $product = new Product($db);
        $product->fetch($orderDTO->getProductId());
        $productDTOMapper = new ProductDTOMapper();
        $productDTO = $productDTOMapper->toProductDTO($product);

        $order->date = $orderDTO->getDate()->getTimestamp();
        $order->socid = $orderDTO->getSupplierId();
        $order->ref_customer = $orderDTO->getCustomerId();

        $orderLine->fk_product = $orderDTO->getProductId();
        $orderLine->desc = $productDTO->getLabel();
        $orderLine->subprice = $productDTO->getTaxFreePrice();
        $orderLine->qty = $orderDTO->getQuantity();
        $order->lines[] = $orderLine;

        return $order;
    }
}
