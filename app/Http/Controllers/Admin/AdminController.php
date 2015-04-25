<?php namespace App\Http\Controllers\Admin;

use App\Categori;
use App\Http\Controllers\Controller;
use App\Services\RenderCategoriManager;
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

    public function getAdd($categoriId)
    {
       Categori::find($categoriId)->children()->create(['name' => 'Child 1']);

        return view('admin.admin');
    }

    public function getDell($categoriId)
    {
        Categori::find($categoriId)->delete();

        return view('admin.admin');
    }

    public function getUpdate()
    {
        return view('admin.admin');
    }
}
