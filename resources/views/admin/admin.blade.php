@extends('app')

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
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
            <div class="actives">Name of Category</div><div><input  type="text" width="120" height="10"></div>
            <button id="CategorySiblingCreateButton" type="button" class="btn btn-primary">Make Sibling</button>
            <button id="CategoryCreateButton" type="button" class="btn btn-primary">Make Child</button>

        </div>
    </div>
@endsection

@section('logo')
            <li><a href="{{ url('/auth/admin') }}">Logo</a></li>
@endsection

@section('scripts')

            <script type="text/javascript" src="{{ asset('/jquery/Category.js') }}"></script>

@endsection