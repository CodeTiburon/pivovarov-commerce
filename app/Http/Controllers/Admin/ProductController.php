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
            'name'        => 'required|unique:products',
            'selected'    => 'required',
            'Description' => 'required',
            'price'       =>' required|integer',
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
        if ($currentProduct->photo_id != 3) {
            $firstPhoto = $currentProduct->ProductToPhoto()->where('id', '=', $currentProduct->photo_id)->get();
            $secondaryPhotos = Product::find($productId)->ProductToPhoto()->where('id', '!=', $currentProduct->photo_id)->orderBy('order')->get();
            $tree = Categori::all()->toHierarchy();
            return view('admin.more', ['product' => $currentProduct,'secondaryPhotos' =>$secondaryPhotos,
                'firstPhoto' =>$firstPhoto[0],'tree' => $tree]);
        } else {
            $tree = Categori::all()->toHierarchy();
            return view('admin.more', ['product' => $currentProduct,
                                'firstPhoto' => null,'tree' => $tree]);
        }
    }

    public function postProductUpdate(V $request, $id , ProductManager $productManager)
    {
        $this->validate($request, [
            'name'        => 'required',
            'Description' => 'required',
            'price'       =>' required|integer',
        ]);

        $data = Request::all();
        $productManager->productUpdate($data,$id);

        $redir = array('redirect'=>url('/product'));
        return response()->json($redir);
    }

    public function postMakeGeneralPhoto(ProductManager $productManager)
    {
        $data = Request::all();
        $productManager->makeGeneral($data);
    }
}

