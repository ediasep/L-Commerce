@extends('layouts.app')

@section('content')
<br>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                @include('component.productcarousel', ['images' => $product->images])
            </div>    
        </div>

        <div class="col-md-4">
            <h2>{{ $product->name }}</h2>
            <p>
                <div class="font-weight-bold">{{ __('Seller') }} :</div> 
                <small class="text-muted">{{ $product->vendor() }}</small>
                <div class="font-weight-bold mt-4">{{ __('Price') }} :</div>
                <h3 class="mt-2">{{ $localization_setting->currency }} {{ $product->price }}</h3>
            </p>
            
            <a href="{{ route('cart.create', $product->slug) }}" class="btn btn-lg btn-success btn-block btn-flat mt-5">{{ __('Buy Now') }}</a>
            <a href="{{ route('cart.create', $product->slug) }}" class="btn btn-lg btn-primary btn-flat btn-block">{{ __('Add to Cart') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">{{ __('Review') }}</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <br>
                  <p class="text-muted">{{ $product->description }}</p>
              </div>
              <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">...</div>
            </div>
        </div>
    </div>
</div>
@endsection
