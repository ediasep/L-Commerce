@extends('layouts.app')

@section('content')
<!--Jumbotron-->
<div class="jumbotron text-center rounded-0">
    <!--Title-->
    <h1 class="card-title h2-responsive mt-5 text-success"><strong>{{ $general_setting->site_title }}</strong></h1>
    <!--Subtitle-->
    <p class="mb-4 lead">{{ $general_setting->site_subtitle }}</p>

    <!--Text-->
    <div class="d-flex justify-content-center">
        <p class="text-muted mb-3" style="max-width: 43rem;">{{ $general_setting->site_desc }}
    </div>

    <hr class="my-4">

    <a href="{{ route('product.index') }}" type="button" class="btn btn-primary btn-lg waves-effect btn-flat">{{ __('Browse Product') }}</a>
    <a href="{{ route('product.create') }}" type="button" class="btn btn-success btn-lg btn-flat waves-effect">{{ __('Start Selling') }}</a>

</div>
<!--Jumbotron-->

<div class="container wrapper">
    <!--Products-->
    <div class="row">
        @foreach($products as $product)

            <div class="col-md-4 mb-5">
                @include('component.product_thumbnail')
            </div>

        @endforeach
    </div>
    <!--Products-->

</div>

<div class="py-5 home-section bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="circle-icon text-success">
                    <i class="fas fa-shield-alt"></i>
                </div>
                
                <h5 class="font-bold">Guaranted 100% Secure</h5>
            </div>

            <div class="col-md-4 text-center">
                <div class="circle-icon text-success">
                    <i class="far fa-money-bill-alt"></i>
                </div>

                <h5 class="font-bold">Easy Payment</h5>
            </div>

            <div class="col-md-4 text-center">
                <div class="circle-icon text-success">
                    <i class="fas fa-shipping-fast"></i>
                </div>

                <h5 class="font-bold">Lots of Shipping option</h5>
            </div>
        </div>
    </div>
</div>
@stop
