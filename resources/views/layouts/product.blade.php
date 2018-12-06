@extends('layouts.app')

@section('content')

<div class="container mt-5">

  <div class="row">

    <div class="col-md-3">

      <div class="list-group list-group-menu mb-3">
          <li href="#" class="list-group-item disabled rounded-0">
            <h6 class="mb-1">{{ __('PRODUCTS') }}</h6>
          </li>

          <a href="{{ route('product.my') }}" class="list-group-item list-group-item-action {{ isActiveRoute('product.my') }}">
            <i class="fa fa-box"></i> {{ __('My Product') }}
          </a>
          
          <a href="{{ route('product.create') }}" class="list-group-item list-group-item-action {{ isActiveRoute('product.create') }}">
            <i class="fa fa-plus"></i> {{ __('Add Product') }}
          </a>

          <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action rounded-0 {{ isActiveRoute(['order.index', 'order.show', 'order.sales']) }}">
            <i class="fas fa-exchange-alt"></i> {{ __('Transaction') }}
          </a>
      </div> <!-- //.list-group -->

    </div> <!-- //.col-md-3 -->

    <div class="col-md-9">
          @yield('section')
    </div> <!-- //.col-md-9 -->

  </div> <!-- //.row -->

</div> <!-- //.container -->
@endsection
