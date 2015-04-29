<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_Product extends Model
{
    protected $table = 'category_product';

    protected $fillable = ['category_id', 'product_id'];

    public function showAll()
    {
        return Category_Product::all();
    }

    public function CreateCategoryProduct(array $data)
    {
        return Category_Product::create([
            'category_id' => $data['selected'],
            'product_id' => $data['id'],
        ]);
    }

}