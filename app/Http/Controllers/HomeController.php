<?php namespace App\Http\Controllers;

use App\Categori;
use App\Models\Photo;
use Request;
use App\Models\Product;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	public function __construct(Request $request)
	{
//		$this->middleware('auth');
	}

	public function getIndex()
	{
        $tree = Categori::all()->toHierarchy();
		return view('home',['tree' => $tree]);
	}

    public function postTakeProducts()
    {
        $categoryId = Request::input('categoryId');
        $category = Categori::find($categoryId);
        $products = $category->CategoryToProduct()->paginate(5);
        $productsAll=array();
        $uploadDir = 'photo/';
        foreach ($products as $product) {
//            $photo = $product->ProductToPhoto()->where('order', '=', '1')->get();
            $photo = $product->photo_id;
            $firstPhoto = Photo::find($photo);
            if($firstPhoto !== null) {
                $productArray = $product->toArray();
                $productArray['photo']=$uploadDir . $firstPhoto->image;
                $productsAll[] = $productArray;
//                  $product->photo = $uploadDir . $firstPhoto->image;
            } else {
                $productArray = $product->toArray();
                $productArray['photo'] = $uploadDir . 'nophoto.jpg';
                $productsAll[] = $productArray;
//                  $product->photo = $uploadDir . 'nophoto.jpg';
            }
        }

        $send = array('products' => $productsAll);
        return response()->json($send);
    }

    public function getProduct($productId)
    {
        $currentProduct = Product::find($productId);
        if ($currentProduct->photo_id != 3) {
            $firstPhoto = $currentProduct->ProductToPhoto()->where('id', '=', $currentProduct->photo_id)->get();
            $secondaryPhotos = Product::find($productId)->ProductToPhoto()->where('id', '!=', $currentProduct->photo_id)->orderBy('order')->get();
            return view('client.product', ['product' => $currentProduct,'secondaryPhotos' =>$secondaryPhotos,
                'firstPhoto' =>$firstPhoto[0]]);
        } else {
            return view('client.product', ['product' => $currentProduct,
                'firstPhoto' => null]);
        }
    }

}
