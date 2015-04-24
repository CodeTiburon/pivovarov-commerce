<?php namespace App\Http\Controllers\Admin;

use App\Categori;
use App\Http\Controllers\Controller;
use App\Services\RenderCategoriManager;
use Illuminate\Http\Request;
use RenderTree;
use App;


class AdminController extends Controller {

    public function __construct(RenderCategoriManager $helper)
    {
        $this->middleware('admin');
        $this->helper=$helper;
    }
	public function getIndex()
	{
        $tree = Categori::all()->toHierarchy();

        return view('admin.admin', ['tree' => $tree])->with(['helper'=>$this->helper]);
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

    }
}
