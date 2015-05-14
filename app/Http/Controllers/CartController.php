<?php namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Photo;
use App\Models\Product;
use App\Services\OrderManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Request;
use Illuminate\Http\Request as IllumRequest;

class CartController extends Controller
{
    public function postAddProduct()
    {

        $data = Request::all();
        $id = $data['productId'];

        if(Session::has('cart.'.$id))
        {
            $quantity = Session::get('cart.'.$id);
            ++$quantity;
            Session::put('cart.'.$id, $quantity);
        }
        else
        {
            Session::put('cart.'.$id, 1);
        }

        $productIds = Session::get('cart');
        $products = DB::table('products')->whereIn('id', array_keys($productIds))->get();
        $priceSum =0;
        $quantity = array_sum($productIds);
        foreach ($products as $product){
            $priceSum += $product->price * $productIds[$product->id];
        }
//        Session::forget('cart');
        return response()->json(array('quantity'=>$quantity,'price'=>$priceSum));
    }

    public function getGetProduct()
    {
        if(Session::has('cart')) {
            $productIds = Session::get('cart');
            $products = DB::table('products')->whereIn('id', array_keys($productIds))->get();
            $priceSum =0;
            foreach ($products as $product){
                $priceSum += $product->price * $productIds[$product->id];
                $product->quantity = $productIds[$product->id];
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
            return view('client.order',['products' => null]);
        }
    }
    public function getAddress()
    {
        return view('client.apply');
    }
    public function postConfirm(OrderManager $orderManager, IllumRequest $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'phone'   => 'required|numeric',
        ]);

        $data = Request::all();
        $products = Session::get('cart');
        $orderManager->newOrder($data,$products);
    }
    public function postDeleteProduct()
    {
        $data = Request::all();
        Session::forget('cart.'.$data['productId']);
        $productId = Session::get('cart');
        $quantity = array_sum($productId);
        $products = DB::table('products')->whereIn('id', array_keys($productId))->get();
        $priceSum =0;
        foreach ($products as $product){
            $priceSum += $product->price * $productId[$product->id];
        }
        return response()->json(array('price'=>$priceSum,'quantity'=>$quantity));

    }
    public function postUpdateQuantity(IllumRequest $request)
    {
        $id = $request['productId'];
        $newQuantity = $request['quantity'];
        if ($newQuantity > 0){
            Session::put('cart.'.$id, $newQuantity);
            $productIds = Session::get('cart');
            $quantity = array_sum($productIds);
            $products = DB::table('products')->whereIn('id', array_keys($productIds))->get();
            $priceSum =0;
            foreach ($products as $product){
                $priceSum += $product->price * $productIds[$product->id];
            }
            return response()->json(array('quantity' => $quantity,'price' => $priceSum));
        } else {
            $this->clearProduct($id);
            $productIds = Session::get('cart');
            $quantity = array_sum($productIds);
            $products = DB::table('products')->whereIn('id', array_keys($productIds))->get();
            $priceSum =0;
            foreach ($products as $product){
                $priceSum += $product->price * $productIds[$product->id];
            }
            return response()->json(array('quantity'=>0,'price' => $priceSum,'quantityAll' => $quantity));
        }
    }
    public function clearProduct($id)
    {
        Session::forget('cart.'.$id);
    }
}