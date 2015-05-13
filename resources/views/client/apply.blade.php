@extends('app')

@section('content')

    <form id="products_add"  class="form-horizontal" role="form" method="POST" action="{{ url('cart/confirm') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
        <div id="product_create">
            Enter your details
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Please Enter your Address</label>
            <div class="col-md-6">
                <input type="text" id="address" class="form-control" name="address" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Please Enter your Phone</label>
            <div class="col-md-6">
                <input type="text" id="phone" class="form-control" name="phone" value="{{ old('name') }}">
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="bth btn-lg btn-success">
                    Confirm
                </button>
            </div>
        </div>
    </form>

@endsection