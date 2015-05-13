<?php namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Photo;
use App\Models\Product;
use App\Services\OrderManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Request;

class CartController extends Controller
{
    public function postAddProduct()
    {
        $data = Request::all();
        $productIds = Session::pull('productId');
        $productIds[] =  $data['productId'];
        $quantity = count($productIds);
        Session::put('productId', $productIds);
//        Session::forget('productId');
        $products = DB::table('products')->whereIn('id', $productIds)->get();
        $priceSum =0;
        foreach ($products as $product){
            $quantityId = array_count_values($productIds);
            $priceSum += $product->price * $quantityId[$product->id];
        }
        return response()->json(array('quantity'=>$quantity,'price'=>$priceSum));
    }

    public function getGetProduct()
    {
        if(Session::get('productId')) {
            $productIds = Session::get('productId');
            $products = Product::find($productIds);
            $priceSum =0;
            foreach ($products as $product){
                $quantityId = array_count_values($productIds);
                $priceSum += $product->price * $quantityId[$product->id];
                $product->quantity = $quantityId[$product->id];
            }
            $uploadDir = 'photo/';
            foreach ($products as $product) {
                $photo = $product->photo_id;
                $firstPhoto = Photo::find($photo);
                if($firstPhoto !== null) {
                    $product->photo = $uploadDir . $firstPhoto->image;
                    $productsAll[] = $product;
                } else {
                    $product->photo = $uploadDir . 'nophoto.jpg';
                    $productsAll[] = $product;
                }
            }
            return view('client.order',['products' => $productsAll,'priceSum' => $priceSum]);
        } else {
            return view('client.order');
        }
    }
    public function getAddress()
    {
        return view('client.apply');
    }
    public function postConfirm(OrderManager $orderManager)
    {
        $data = Request::all();
        $productsIds =Session::get('productId');
        $orderManager->newOrder($data,$productsIds);
        return redirect(url('/'));
    }
    public function postDeleteProduct()
    {
        $data = Request::all();
        $productIds = Session::get('productId');

    }
}