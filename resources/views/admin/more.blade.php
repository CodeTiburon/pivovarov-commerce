@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="product_name">
            {{$product->name}}
            </div>
        </div>
    </div>

    <div id="product_photos">
        <div id="first_photo">
        <a class="fancybox" rel="group" href="{{asset('photo'.'/'.$firstPhoto->image)}}"><img data-photo_id="{{$firstPhoto->id}}" src="{{asset('photo'.'/'.$firstPhoto->image)}}" alt="альтернативный текст" width="400" height="300" /></a>
        </div>
        <div id="secondary_photo">
        @foreach($secondaryPhotos as $secondaryPhoto)
        <a class="fancybox" rel="group" href="{{asset('photo'.'/'.$secondaryPhoto->image)}}"><img data-photo_id="{{$secondaryPhoto->id}}" src="{{asset('photo'.'/'.$secondaryPhoto->image)}}" alt="альтернативный текст" width="50" height="40" /></a>
        @endforeach
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