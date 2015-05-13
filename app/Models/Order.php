<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'address','phone'];

    public function orderToProduct()
    {
        return $this->belongsToMany('App\Models\Product','orders_session','order_id','product_id');
    }

//    public function createOrder($data)
//    {
//        return Order::create([
//            'user_id' => $data['userId'],
//            'address' => $data['address'],
//            'phone' => $data['phone'],
//        ]);
//    }

}