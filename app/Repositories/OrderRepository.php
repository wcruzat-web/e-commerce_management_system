<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function addItem(Order $order, array $data): OrderItem
    {
        return $order->items()->create($data);
    }

    public function loadItems(Order $order): Order
    {
        return $order->load('items.product');
    }
}
