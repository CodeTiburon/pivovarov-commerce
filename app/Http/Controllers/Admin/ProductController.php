<?php namespace App\Http\Controllers\Admin;
use App\Categori;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Request;
use Illuminate\Http\Request as V;
use App\Services\ProductManager;

class ProductController extends Controller

{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getIndex()
    {
        $tree = Categori::all()->toHierarchy();
        $products = Product::all();

        return view('admin.product', ['tree' => $tree,'products' => $products]);
    }
    public function postProductAdd(ProductManager $productManager, V $request)
    {
        $this->validate($request, [
                                    'name'        => 'required|unique:products|alpha',
                                    'selected'    => 'required',
                                    'Description' => 'required',
                                  ]);


        $data = Request::all();
        $files = Request::file('photo');
                        //Create product, insert in to category_product
        $product = $productManager->NewProduct($data);
                        //Move Photo and insert in to Photo table
        $productManager->NewPhoto($files,$product);

        $ok = array('ok'=>'ok');
        return response()->json($ok);

    }
 }
