<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = ['image', 'product_id'];

    public function showAll()
    {
        return Photo::all();
    }

    public function CreatePhoto(array $data)
    {
        return Photo::create([
            'image' => $data['image'],
            'product_id' => $data['id'],
        ]);
    }

}