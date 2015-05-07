@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
                <input id = "token"type="hidden" name="token" value="{{ \RenderTree::tokenEncrypt() }}">

                <div class="panel-heading category client_categories">
                    Categories
                </div>
                <div id="client_tree">
                    <ul>
                        @foreach($tree as $category)
                            <?php print_r(RenderTree::makeClientTree($category)); ?>
                        @endforeach
                    </ul>
                </div>

            </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('/jquery/client-category-tree.js') }}"></script>

@endsection
