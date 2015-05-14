<?php namespace App\Services;

use App\Models\Order;
use App\Models\OrderSession;
use Illuminate\Support\Facades\Session;

class OrderManager
{
    public function newOrder($data,$productsIds)
    {
        $order = new Order([  'user_id' => $data['userId'],
                              'address' => $data['address'],
                                'phone' => $data['phone'],
                           ]);
        $order->save();
        $currentOrder = $order->id;
        $this->newOderSession($productsIds,$currentOrder);
        Session::forget('cart');
//        $order->orderToProduct()->sync($productsIds);
    }
    public function newOderSession($productsIds,$currentOrder)
    {
        foreach($productsIds as $id=>$quantitty) {
            $orderSession = new OrderSession([  'order_id'    => $currentOrder,
                                                'product_id' => $id,
                                                'quantity'   =>  $quantitty,
            ]);
            $orderSession->save();
        }
    }
}