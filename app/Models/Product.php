<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description','photo_id'];
    public function showAll()
    {
        return Product::all();
    }

    public function createProduct(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'description' => $data['Description'],
            'photo_id' => 3,
        ]);
    }

}