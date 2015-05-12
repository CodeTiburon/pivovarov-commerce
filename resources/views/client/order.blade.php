@extends('app')

@section('content')
    <div id="back_to_product">
        <a href="{{ url('/') }}"><button id="back_to_list" type="submit" class="btn btn-default">
                Back to Category
            </button></a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="table">

            </div>
        </div>
        <div class="row">
            <div class="coll-md-1 col-lg-offset-5">
                <div id="back_to_product">
                    <a href="{{ url('#') }}"><button id="back_to_list" type="submit" class="bth btn-lg btn-success bay">Apply</button></a>
            </div>
        </div>
    </div>



@endsection