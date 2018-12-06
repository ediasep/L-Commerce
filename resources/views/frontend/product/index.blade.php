@extends('layouts.app')

@section('content')
<!--Jumbotron-->
<div class="jumbotron rounded-0">
  <div class="container">
  <div class="row">
    <div class="col-md-12 text-muted text-center">
      <h5 class="mb-3">
        &nbsp;
        <i class="fa fa-credit-card"></i>
        <b>{{ __('PRODUCTS') }}</b>
      </h5>
      <hr>
    </div>
  </div>

    <form action="{{ route('product.index') }}" method="GET">
      <div class="row">
        <div class="col-md-3">
            <select name="category" class="form-control" id="category">
                <option value="">-- {{ __('Select Category') }} --</option>
                @foreach($categories as $category)
                  <option value="{{ $category->name }}" {{ app('request')->input('category') == $category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="word" value="{{ app('request')->input('word') }}" placeholder="{{ __('Search in category') }}" aria-label="Search Product">
        </div>
        <div class="col-md-2">
            <input id="min-price" type="number" value="{{ app('request')->input('min_price') }}" class="form-control" name="min_price" placeholder="{{ __('Min Price') }}" aria-label="Min">
        </div>
        <div class="col-md-2">
            <input id="max-price" type="number" value="{{ app('request')->input('max_price') }}" class="form-control" name="max_price" placeholder="{{ __('Max Price') }}" aria-label="Max">
        </div>
        <div class="col-md-2">
          <input type="submit" value="{{ __('Search') }}" class="btn btn-primary btn-block btn-flat">
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Jumbotron -->

<div class="container wrapper mt-5">
  <div class="row">
      <div class="col-md-12">
        <div class="row">
          @foreach($products as $product)
            <div class="col-md-4 mb-5">
              @include('component.product_thumbnail')
            </div>
          @endforeach
        </div>
      </div>
  </div>
</div>
@stop
