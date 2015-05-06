<?php namespace App\Services;


use App\Models\Photo;
use App\Models\Product;

class ProductManager
{
    public function NewProduct($data)
    {
        $product = new Product(['name'        => $data['name'],
                                'description' => $data['Description'],
                                'photo_id'    => 3]);
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
                                          'image'      => $fileName,]);
                $photoUpload->save();

                $photo->move($uploadDir, $fileName);

                $image = new \Imagick($uploadfile);
                if($image->getImageWidth() >800 && $image->getImageHeight() > 600) {
                    $image->thumbnailImage(1250, 0);
                    $image->writeImage();
                }
            }
            $firstPhoto = Product::find($product->id)->ProductToPhoto()->first();
            $product->photo_id = $firstPhoto->id;
            $product->save();
        }
        else{
            exit();
        }
    }
    public function productUpdate($data,$id)
    {
        $product = Product::find($id);

        if(isset($data['selected'])) {
            $product->ProductToCategory()->attach($data['selected']);
        }

        $product->update(['name' => $data['name'] ,'description' => $data['Description'] ]);

    }

    public function makeGeneral($data)
    {
        $product = Product::find($data['productId']);
        $product->photo_id = $data['photoId'];
        $product->save();
    }
}