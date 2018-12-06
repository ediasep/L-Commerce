@extends('layouts.app')

@section('content')

<div class="container mt-5">

  <div class="row">

    <div class="col-md-3">

      <div class="list-group list-group-menu">
          <li href="#" class="list-group-item disabled rounded-0">
            <h6 class="mb-1">{{ __('SETTINGS') }}</h6>
          </li>

          <a href="{{ route('account') }}" class="list-group-item list-group-item-action {{ isActiveRoute('account') }}">
            <i class="fa fa-user"></i> {{ __('Account') }}
          </a>

          <a href="{{ route('shop.create') }}" class="list-group-item list-group-item-action {{ isActiveRoute(['shop.create', 'shop.edit']) }}">
            <i class="fa fa-shopping-basket"></i> {{ __('Shop') }}
          </a>

          <a href="{{ route('address.index') }}" class="list-group-item list-group-item-action {{ isActiveRoute(['address.create', 'address.index', 'address.edit']) }}">
            <i class="fas fa-address-book"></i> {{ __('Address') }}
          </a>

          <a href="#" class="list-group-item list-group-item-action">
            <i class="fas fa-shipping-fast"></i> {{ __('Shipping') }}
          </a>

          <a href="#" class="list-group-item list-group-item-action rounded-0">
            <i class="far fa-credit-card"></i> {{ __('Payment') }}
          </a>
      </div> <!-- //.list-group -->

    </div> <!-- //.col-md-3 -->

    <div class="col-md-9">
          @yield('section')
    </div> <!-- //.col-md-9 -->

  </div> <!-- //.row -->

</div> <!-- //.container -->
@endsection
