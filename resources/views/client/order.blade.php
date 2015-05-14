@extends('app')

@section('content')
    <div id = 'messege' >

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
                <div id="back_to_product">
                    <a href="{{ url('/') }}"><button id="back_to_list" type="submit" class="btn btn-default">
                            Back to Category
                        </button></a>
                </div>
            </div>
        </div>
    <div>
    <input id = "token" type="hidden" name="token" value="{{ \RenderTree::tokenEncrypt() }}">
    @if($products)
        <div class="container-fluid cart_content">
             <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                       <table class="table table-striped">
                        <tr>
                            <th class="text-center">Delete Product</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Chenge Quantity</th>
                        </tr>
                        @foreach($products as $product)
                        <tr class="text-center">
                            <td><button data-product_id="{{$product->id}}" id="back_to_list" type="submit" class="btn btn-danger btn-sm delete">Delete</button></td>
                            <td><img data-product_id="{{$product->id}}" class="client_product_photo img-rounded" src="{{asset($product->photo)}}" alt="" width="50" height="50"/></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td><input class="quantity" type="number" min="0" max="999" value="{{$product->quantity}}"></td>
                            <td><button data-product_id="{{$product->id}}" id="back_to_list" type="submit" class="btn btn-warning btn-sm change">Change</button></td>
                        </tr>
                        @endforeach
                    </table>
                  </div>
             </div>

            <div class="sum_order">
                <div>
                    Sum of your Order is:  <span class="change_sum">{{Product::price(Session::get('cart'))}} $
                </div>
            </div>

            @if (Auth::guest())
                <div class="apply_btn">
                    <div id="back_to_product">
                        <a href="{{ url('/auth/register') }}"><button id="back_to_list" type="submit" class="bth btn-lg btn-success bay">Apply</button></a>
                    </div>
                </div>
            @else
                <div class="apply_btn">
                    <div id="back_to_product">
                        <a href="{{ url('/cart/address') }}"><button id="back_to_list" type="submit" class="bth btn-lg btn-success bay">Apply</button></a>
                    </div>
                </div>
            @endif
        </div>
    @else

         <div class="text-center no_products">
          У вас нет ни одной покупки! Купите хоть что нибудь
         </div>
    @endif



@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/jquery/order.js') }}"></script>
@endsection