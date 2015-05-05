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

        return view('admin.product', ['tree' => $tree, 'products' => $products]);
    }

    public function postProductAdd(ProductManager $productManager, V $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products|alpha',
            'selected' => 'required',
            'Description' => 'required',
        ]);


        $data = Request::all();
        $files = Request::file('photo');
        //Create product, insert in to category_product
        $product = $productManager->NewProduct($data);
        //Move Photo and insert into Photo table
        $productManager->NewPhoto($files, $product);

        $ok = array('ok' => 'ok');
        return response()->json($ok);

    }

    public function postProductDelete(V $request)
    {
        $categoryId = $request->input('catid');
        $productId  = $request->input('prodid');
        $currentProduct = Product::find($productId);
        $currentProduct->ProductToCategory()->detach(['category_id'=>$categoryId]);
        $currentCategory = $currentProduct->ProductToCategory()->get();

        if (!$currentCategory->toArray()){
            $photos = $currentProduct->ProductToPhoto()->get();
                foreach ($photos as $photo) {
                    unlink(base_path() . '/public/photo/' . $photo->image);
                    $photo->delete();
                }
            $currentProduct->ProductToPhoto()->delete();
            $currentProduct->delete();
            $delete = array('delete'=>'ok');
            return response()->json($delete);
        }
    }

    public function getMore($productId)
    {
        $currentProduct = Product::find($productId);
        $firstPhoto = Product::find($productId)->ProductToPhoto()->first();
        $secondaryPhotos = Product::find($productId)->ProductToPhoto()->where('id', '!=', $firstPhoto->id)->get();



        return view('admin.more', ['product' => $currentProduct,'secondaryPhotos' =>$secondaryPhotos,
                                    'firstPhoto' =>$firstPhoto]);
    }
}

