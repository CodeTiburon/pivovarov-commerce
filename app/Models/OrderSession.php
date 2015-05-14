<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSession extends Model
{
    protected $table = 'orders_session';

    protected $fillable = ['order_id', 'product_id','quantity'];

//    public function createOrderSession($data)
//    {
//        return Order::create([
//            'user_id' => $data['userId'],
//            'address' => $data['address'],
//            'phone' => $data['phone'],
//        ]);
//    }
}