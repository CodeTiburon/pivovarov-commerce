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
        <div id="text">

        </div>
    </div>
@endsection

@section('logo')
            <li><a href="{{ url('/auth/admin') }}">Logo</a></li>
@endsection

@section('scripts')

            <script type="text/javascript" src="{{ asset('/jquery/Category.js') }}"></script>

@endsection