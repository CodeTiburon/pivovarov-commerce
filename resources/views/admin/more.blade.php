@extends('app')

@section('content')
    <div id="back_to_product">
    <a href="{{ url('/product') }}"><button id="back_to_list" type="submit" class="btn btn-default">
            Back to Product
        </button></a>
    </div>
    <div class="container-fluid">
        <div id = 'successmessage'>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div id="product_name">
            {{$product->name}}
            </div>
        </div>
    </div>
    @if($firstPhoto)
    <div id="product_photos">
        <div id="first_photo">
            <input id = "token"type="hidden" name="token" value="{{ \RenderTree::tokenEncrypt() }}">
            <button data-product_id="{{$product->id}}" type="button" class="btn btn-default btn-xs make_general_photo first">Make Primary</button>
            <a class="fancybox" rel="group" href="{{asset('photo'.'/'. $firstPhoto->image)}}">
                <img class="zoom general_photo " data-product_id="{{$product->id}}" data-zoom-image="{{asset('photo'.'/'.$firstPhoto->image)}}" data-photo_id="{{$firstPhoto->id}}" data-photo_order="{{$firstPhoto->order}}" src="{{asset('photo'.'/'.$firstPhoto->image)}}" alt="альтернативный текст" width="300" height="200" />
            </a>
        </div>
        <div id="secondary_photo" class="sort">
        @foreach($secondaryPhotos as $secondaryPhoto)
            <div class="sort_photo" data-photo_id="{{$secondaryPhoto->id}}"  data-photo_order="{{$secondaryPhoto->order}}">
                <button data-product_id="{{$product->id}}" type="button" class="btn btn-default btn-xs make_general_photo">Make Primary</button>
                <a class="fancybox" rel="group" href="{{asset('photo'.'/'.$secondaryPhoto->image)}}">
                    <img class="secondary_photos" data-product_id="{{$product->id}}" data-photo_order="{{$secondaryPhoto->order}}" data-photo_id="{{$secondaryPhoto->id}}" src="{{asset('photo'.'/'.$secondaryPhoto->image)}}" alt="альтернативный текст" width="300" height="200" />
                </a>
            </div>
        @endforeach
        </div>
    </div>
    @else()
        <div id="client_product_more">
            <div id="first_photo">
                <input id = "token"type="hidden" name="token" value="{{ \RenderTree::tokenEncrypt() }}">
                <a class="fancybox" rel="group" href="{{asset('photo'.'/'. 'nophoto.jpg')}}">
                    <img data-product_id="{{$product->id}}" src="{{asset('photo'.'/'.'nophoto.jpg')}}" alt="альтернативный текст" width="400" height="300" />
                </a>
            </div>
        </div>
    @endif

    <div id="description">
        {{$product->description}}
    </div>

    <div id="update_price">
        Price:{{$product->price}}$
        <div>
            <button type="button" class="btn btn-default save_image">
                Save Photo Order
            </button>
        </div>
    </div>


    <div id="change_form">
        <form id="products_update"  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/product/product-update',$product->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name" value="{{$product->name}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Add Category</label>
                <div class="col-md-6">
                    <select id="select" name="selected[]"  class="multi" multiple >
                        {{ RenderTree::CategoryFilter($tree)}}
                    </select>
                </div>
            </div>
            <div id="product_crumbs">
            {{RenderTree::productCrumbs($product)}}
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea id = "Description" class="form-control" name="Description">{{$product->description}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Price</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Add Photo</label>
                <div class="col-md-6">
                    <input type="file" multiple class="file-loading" name="photo[]">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-default">
                        Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <div id = 'errormessage' >

        </div>
    </div>
    </div>

    <div id="product_update">
        <button id="change" class="btn btn-default" type="button" href="#">Update Product</button>
    </div>
@endsection('content')

@section('scripts')
            <script type="text/javascript" src="{{ asset('/jquery/funcybox/myfancybox.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/jquery/update-product.js') }}"></script>
@endsection