<?php namespace App\Services;


use App\Models\Photo;
use App\Models\Product;

class ProductManager
{
    public function NewProduct($data)
    {
        $product = new Product(['name'        => $data['name'],
                                'description' => $data['Description'],
                                'photo_id'    => 3,]);
        $product->save();
        $product->ProductToCategory()->sync($data['selected']);

        return $product;
    }

    public function NewPhoto($photos,$product)
    {
        if($photos[0]){
            $uploadDir = base_path() . '/public/photo/';
            $productId = $product->id;
            foreach($photos as $photo) {
                $imagePrefix = uniqid();
                $fileName = $imagePrefix . $photo->getClientOriginalName();
                $uploadfile = $uploadDir . $fileName;

                $photoUpload = new Photo(['product_id' => $productId,
                                          'image'      => $uploadfile,]);
                $photoUpload->save();

                $photo->move($uploadDir, $fileName);
            }
        }
        else{
            exit();
        }
    }
}