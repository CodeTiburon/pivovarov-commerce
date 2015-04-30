<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = ['image', 'product_id'];

        public function PhotoToProduct()
    {
        return $this->belongsTo('App\Models\Product');
    }
}