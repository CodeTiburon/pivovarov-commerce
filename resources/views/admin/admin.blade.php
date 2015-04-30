@extends('app')

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/product') }}">Products</a></li>
        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>


@endsection

@section('content')
    <div id="tree">
            <ul>
                @foreach($tree as $tr)
                    <?php print_r(RenderTree::renderTree($tr)); ?>
                @endforeach
            </ul>
<div class="container-fluid">
   <div id = errormessage >

   </div>
</div>
        <div id="text">
            <input id = "token"type="hidden" name="_token" value="{{ \RenderTree::tokenEncrypt() }}">
            <div class="actives" id="cat_name">Name of Category</div><div><input id="categ" type="text" width="120" height="10"></div>
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