@extends('layouts.product')

@section('section')
<div class="card rounded-0">
  <div class="card-body">
    <h5 class="text-uppercase font-weight-bold">{{ __('My Product') }}</h5>
    <br>
    <div class="list-group mb-3">
    @foreach($products as $product)
      <li class="list-group-item rounded-0">
        <div class="row">
          <div class="col-md-2">
            <img class="img-fluid" width="100" src="{{ $product->images->first()->url }}" alt="">
          </div>
          <div class="col-md-10 d-flex w-100 justify-content-between">
              <h5>{{ $product->name }}</h5>

              <div>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('product.show', $product->slug) }}">{{ __('Detail') }}</a> &nbsp; 
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('product.edit', $product->slug) }}">{{ __('Edit') }}</a> &nbsp;
                <a class="btn btn-sm btn-outline-secondary" href=""
                   onclick="event.preventDefault();
                                 document.getElementById('delete-form-{{$product->slug}}').submit();">
                    {{ __('Delete') }}
                </a>
              </div>

              <form id="delete-form-{{$product->slug}}" action="{{ route('product.destroy', $product->slug) }}" method="POST" style="display: none;">
                  <input type="hidden" name="_method" value="delete">
                  @csrf
              </form>
          </div>
        </div>
      </li>
    @endforeach
    </div>
    
    {{ $products->links() }}
  </div>
</div>
@endsection
