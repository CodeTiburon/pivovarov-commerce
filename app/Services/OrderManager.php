<?php namespace App\Services;

use App\Models\Order;

class OrderManager
{
    public function newOrder($data,$productsIds)
    {
        $order = new Order([  'user_id' => $data['userId'],
                              'address' => $data['address'],
                                'phone' => $data['phone'],
                           ]);
        $order->save();
        $order->orderToProduct()->sync($productsIds);
    }
}