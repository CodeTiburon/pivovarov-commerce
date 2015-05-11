@extends('app')

@section('content')
    <div id="back_to_product">
        <a href="{{ url('/') }}"><button id="back_to_list" type="submit" class="btn btn-default">
                Back to Category
            </button></a>
    </div>

<div class="container-fluid">
        <div class="row">
            <div id="product_name">
                {{$product->name}}
            </div>
        </div>

    @if($firstPhoto)
        <div id="client_product_more">
            <div id="first_photo">
                <input id = "token"type="hidden" name="token" value="{{ \RenderTree::tokenEncrypt() }}">
                <a class="fancybox" rel="group" href="{{asset('photo'.'/'. $firstPhoto->image)}}">
                    <img class="zoom" data-product_id="{{$product->id}}" data-zoom-image="{{asset('photo'.'/'.$firstPhoto->image)}}" data-photo_id="{{$firstPhoto->id}}" src="{{asset('photo'.'/'.$firstPhoto->image)}}" alt="альтернативный текст" width="400" height="300" />
                </a>
            </div>
            <div id="secondary_photo">
                @foreach($secondaryPhotos as $secondaryPhoto)
                    <a class="fancybox" rel="group" href="{{asset('photo'.'/'.$secondaryPhoto->image)}}">
                        <img class="zoom secondary_photos" data-product_id="{{$product->id}}" data-photo_id="{{$secondaryPhoto->id}}" src="{{asset('photo'.'/'.$secondaryPhoto->image)}}" alt="альтернативный текст" width="200" height="150" />
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div id="description">
        {{$product->description}}
    </div>

    <div id="price">
        Price:{{$product->price}}$
        <div>
            <button class="bth btn-lg btn-success bay" data-product_id="{{$product->id}}" type="button">Bay now</button>
        <div>
    </div>
</div>


@endsection('content')

@section('scripts')
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/myfancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/bay.js') }}"></script>
@endsection