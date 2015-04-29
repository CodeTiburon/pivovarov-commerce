<?php namespace App\Http\Controllers\Admin;
use App\Categori;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Category_Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class ProductController extends Controller

{
    protected $_photo;
    protected $_product;
    protected $_my_request;
    protected $_category_product;

    public function __construct(Product $product,Request $request,Category_Product $category_product,Photo $photo)
    {
        $this->_photo            = $photo;
        $this->_category_product = $category_product;
        $this->_my_request       = $request;
        $this->_product          = $product;
        $this->middleware('admin');
    }

    public function getIndex()
    {
        $category_array = Categori::getNestedList('name', null, $seperator = ' &#8722; ');

        return view('admin.product', ['tree' => $category_array]);
    }
    public function postProductAdd()
    {           //Product
        $data_product = $this->_my_request->all();
        $current_product = $this->_product->createProduct($data_product);
                //Category_product
        dd($this->_my_request->input('selected'));
        $data_category_product = $this->_my_request->only('selected');
        $data_category_product['id'] = $current_product->id;
        $this->_category_product->CreateCategoryProduct($data_category_product);
                 //Photo
        $data_photo['image'] = '/test.ru/public/photo/';
        $data_photo['image'].= ($_FILES['photo']['name']);
        $data_photo['id'] = $current_product->id;
        $this->_photo->CreatePhoto($data_photo);
        dd($_FILES);
    }

}