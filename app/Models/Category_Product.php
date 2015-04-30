<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{
    protected $table = 'category_product';

    protected $fillable = ['category_id', 'product_id'];

}