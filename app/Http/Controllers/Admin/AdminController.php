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

    public function postAddchild(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categoris|alpha',
        ]);

         $data = $request->input('id');
         $category = $request->input('name');

        $root = Categori::find($data);
        $sibling = Categori::create(['name' => $category]);
        $sibling->makeChildOf($root);


        $html = RenderTree::renderTree($sibling);

        $parent = $this->findPatentID($sibling);

        $add = array('html'=>$html,'parent_id'=>($parent));
        return response()->json($add);


    }
    public function postAddsibling(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categoris|alpha',
        ]);

        $data = $request->input('id');
        $category = $request->input('name');

        $root = Categori::find($data);
        $sibling = Categori::create(['name' => $category]);
        $sibling->makeSiblingOf($root);

        $html = RenderTree::renderTree($sibling);
        $rootId = $request->input('id');

        $redir = array('html'=>$html,'selected_id'=>($rootId));
        return response()->json($redir);
    }


    public function postDell(Request $request)
    {
        $data = $request->input('id');

        Categori::find($data)->delete();

        $redir = array('selected_id'=>$data);
        return response()->json($redir);
    }

    public function findPatentID($sibling)
    {
        return $sibling->getParentId();
    }
}
