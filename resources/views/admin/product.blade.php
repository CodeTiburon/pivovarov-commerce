@extends('app')

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/admin') }}">Categories</a></li>
        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
    </ul>
@endsection

@section('content')

        <form id="products_add"  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/product/product-add') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Select category</label>
                <div class="col-md-6">
                    <select name="selected"  class="multi" multiple >
                        @foreach($tree as $id => $name)
                            <?php print_r("<option value=".$id.">".$name."</option>");?>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="Description"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Upload photo</label>
                <div class="col-md-6">
                    <input type="file" multiple class="file-loading" name="photo">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    <div class="container-fluid">
       <div id = errormessage >

       </div>
</div>
        <div id="text">
            <input id = "token"type="hidden" name="_token" value="{{ \RenderTree::tokenEncrypt() }}">
            <div class="actives">Name of Category</div><div><input id="categ" type="text" width="120" height="10"></div>
            <button id="CategorySiblingCreateButton" type="button" class="btn btn-primary">Make Sibling</button>
            <button id="CategoryCreateButton" type="button" class="btn btn-primary">Make Child</button>

        </div>
    </div>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete category</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you really wont delete this category?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="confirm" class="btn btn-primary">Ok</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
@endsection

@section('logo')
            <li><a href="{{ url('/auth/admin') }}">Logo</a></li>
@endsection

@section('scripts')

            <script type="text/javascript" src="{{ asset('/jquery/Category.js') }}"></script>

@endsection