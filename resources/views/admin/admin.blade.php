@extends('app')

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>

@endsection

@section('content')
    <ul>
    @foreach($tree as $tr)
       <?php $hi = $helper->renderTree($tr);
            print_r($hi)?>
    @endforeach
    </ul>

@endsection

@section('logo')
            <li><a href="{{ url('/auth/admin') }}">Logo</a></li>
@endsection

@section('scripts')

            <script type="text/javascript" src="{{ asset('/jquery/AddCategory.js') }}"></script>

@endsection