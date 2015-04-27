<?php namespace App\Http\Controllers\Admin;

use App\Categori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RenderTree;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AdminController extends Controller {

    use AuthenticatesAndRegistersUsers;

    public function __construct()
    {
        $this->middleware('admin');
    }
	public function getIndex()
	{
        $tree = Categori::all()->toHierarchy();

        return view('admin.admin', ['tree' => $tree]);
	}

    public function getAddchild(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categoris|alpha',
        ]);

         $data = $request->input('id');
         $category = $request->input('name');

        Categori::find($data)->children()->create(['name' => $category]);

//        $validcategory = $this->redirectPath();
//        $redir = array('redirect'=>$validcategory);
//        return response()->json($redir);

    }
    public function getAddsibling(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categoris|alpha',
        ]);

        $data = $request->input('id');
        $category = $request->input('name');

        $root = Categori::find($data);
        $sibling = Categori::create(['name' => $category]);
        $sibling->makeSiblingOf($root);

    }


    public function getDell(Request $request)
    {
//        $this->validate($request, [
//            'id' => 'required|unique:categoris|alpha',
//        ]);

        $data = $request->input('id');

        Categori::find($data)->delete();

//        $validcategory = $this->redirectPath();
//        $redir = array('redirect'=>$validcategory);
//        return response()->json($redir);
    }

    public function getUpdate(Request $request)
    {

//         $data = $request->all();
//           $category = $request->get('text');
//
//         Categori::find($data)->get('name')->makeChildOf($category);
//
    }

}
