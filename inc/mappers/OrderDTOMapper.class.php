<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/OrderDTO.class.php';
require_once dirname(__DIR__, 4) . '/commande/class/commande.class.php';

class OrderDTOMapper
{
    public function toOrderDTO(\Commande $order): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO
            ->setDate((new \DateTime())->setTimestamp($order->date))
            ->setCustomerId($order->ref_customer ?? 0)
            ->setSupplierId($order->socid ?? 0);

        foreach ($order->lines ?? [] as $line) {
            $orderLineDTO = new OrderLineDTO();
            $orderLineDTO
                ->setUnitprice($line->subprice ?? 0)
                ->setQuantity($line->qty ?? 1)
                ->setDescription($line->desc ?? '')
                ->setDiscount($line->remise_percent ?? 0);

            if(!is_null($line->product) && !is_null($line->product->id)) {
                $orderLineDTO->setProductId($line->product->id);
            }

            $orderDTO->addOrderLine($orderLineDTO);
        }

        return $orderDTO;
    }

    public function toOrder(OrderDTO $orderDTO): \Commande
    {
        global $db, $user;

        $order = new \Commande($db);

        $order->date = $orderDTO->getDate()->getTimestamp();
        $order->socid = $orderDTO->getSupplierId();
        $order->ref_customer = $orderDTO->getCustomerId();

        foreach ($orderDTO->getOrderLines() as $orderLineDTO) {
            $orderLine = new \OrderLine($db);

            $orderLine->fk_product = $orderLineDTO->getProductId();
            $orderLine->desc = $orderLineDTO->getDescription();
            $orderLine->subprice = $orderLineDTO->getUnitprice();
            $orderLine->remise_percent = $orderLineDTO->getDiscount();
            $orderLine->qty = $orderLineDTO->getQuantity();

            $order->lines[] = $orderLine;
        }

        return $order;
    }
}
