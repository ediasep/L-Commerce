@extends('layouts.app')

@section('content')

<div class="container mt-5 wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>Category: "{{$category->name}}"</h1>
        </div>
    </div>

    <br>
    
    <div class="row">
        @foreach($category->products as $product)
        <div class="col-md-4 mb-5">
            <div class="card mb-4 h-100 rounded-0">
                <img class="card-img-top rounded-0" data-src="holder.js/100px225?theme=thumb&amp;bg=#eee&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="{{ url($product->images->first()->url) }}" data-holder-rendered="true">

                <div class="card-body">
                  <p class="card-text">
                    <a href="{{ route('product.show', $product->slug) }}" class="text-muted">{{ str_limit($product->name, 40, '...') }}</a>
                  </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted"><h3>$ {{ $product->price }} </h3></span>
                    <a href="{{ route('cart.create', $product->slug) }}" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
                  </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
