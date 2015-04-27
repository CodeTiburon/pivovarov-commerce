<?php namespace App\Http\Controllers\Admin;

use App\Categori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RenderTree;


class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }
	public function getIndex()
	{
        $tree = Categori::all()->toHierarchy();

        return view('admin.admin', ['tree' => $tree]);
	}

    public function getAdd(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:categoris|alpha',
        ]);

        if ($valid->fails())
        {
            $messages = $valid->messages();
            $errors = array('errors' => $messages);
            json_encode($errors);
            return response()->json($errors);
        }
         $data = $request->get('id');
         $category = $request->get('text');

        Categori::find($data)->children()->create(['name' => $request->get('text')]);

        $validcategory = $this->redirectPath();
        $redir = array('redirect'=>$validcategory);
        return response()->json($redir);

    }

    public function getDell(Request $request)
    {
        //$category = Categori::find($categoriId)->delete();

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
