<?php namespace App\Http\Controllers\Admin;

use App\Categori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Render;


class AdminController extends Controller {


	public function index()
	{
        Render::;
        $tree = Categori::all()->toHierarchy();

        return view('admin.admin', ['tree' => $tree]);
	}
}
