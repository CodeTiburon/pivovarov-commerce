<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description','photo_id','price'];

    public function ProductToCategory()
    {
        return $this->belongsToMany('App\Categori','category_product','product_id','category_id');
    }
    public function ProductToPhoto()
    {
        return $this->hasMany('App\Models\Photo');
    }
    public function productToOrder()
    {
        return $this->belongsToMany('App\Models\Order','orders_session','product_id','order_id');
    }
}