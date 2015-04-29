@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('admin_menu')

    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/admin') }}">Categories</a></li>
        <li><a href="{{ url('/product') }}">Products</a></li>
        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>

@endsection

@section('logo')

       <li><a href="{{ url('/') }}">Logo</a></li>

@endsection