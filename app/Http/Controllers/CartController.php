<?php namespace App\Http\Controllers;

use App\Models\Product;
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
        $sumPrice = 0;
//        Session::forget('productId');
        foreach($productIds as $productId){
            $price = Product::find($productId)->price;
            $sumPrice += $price;
        }
//        $priceSum = DB::table('products')->whereIn('id', $productIds)->sum('price');



        return response()->json(array('quantity'=>$quantity,'price'=>$priceSum));
    }

    public function getGetProduct()
    {
        if(count(Session::get('productId'))!==0) {
            $productIds = Session::get('productId');
            $products = Product::find($productIds);
            $priceSum = DB::table('products')->whereIn('id', $productIds)->sum('price');
            return view('client.order',['products' => $products,'priceSum' => $priceSum]);
        }
        return view('client.order');
    }
}