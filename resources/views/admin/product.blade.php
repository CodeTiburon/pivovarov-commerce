@extends('app')

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/admin') }}">Categories</a></li>
        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
    </ul>
@endsection

@section('content')
    <div id="pageproduct">
        <input id = "tokendelete"type="hidden" name="_tokendelete" value="{{ \RenderTree::tokenEncrypt() }}">
        <?php RenderTree::CategoryCrumbs($products);?>
    </div>
 <div id="form_product_add">
    <div class="container-fluid">
        <div id = 'messege' >

        </div>
    </div>
     <a href="{{ url('/product') }}"><button id="back_to_list" type="submit" class="btn btn-default">
         Back to Product
     </button></a>

        <form id="products_add"  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/product/product-add') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Select category</label>
                <div class="col-md-6">
                    <select id="select" name="selected[]"  class="multi" multiple >
                        {{ RenderTree::CategoryFilter($tree)}}
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea id = "Description" class="form-control" name="Description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Upload photo</label>
                <div class="col-md-6">
                    <input type="file" multiple class="file-loading" name="photo[]">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-default">
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    <div class="container-fluid">
        <div id = 'errormessage' >

        </div>
    </div>
 </div>
@endsection

@section('logo')
            <li><a href="{{ url('/auth/admin') }}">Logo</a></li>
@endsection

@section('scripts')

            <script type="text/javascript" src="{{ asset('/jquery/ProductForm.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/jquery/crumbs.js') }}"></script>

@endsection