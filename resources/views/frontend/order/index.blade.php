@extends('layouts.product')

@section('section')
  	<h5 class="text-uppercase font-weight-bold mb-3">
	  	<i class="fas fa-exchange-alt"></i>
	  	{{ __('Transaction') }}
  	</h5>

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('order.sales') }}">Transaction</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('order.sales') }}">Sales
				<span class="badge badge-danger badge-pill">{{ $salescount }}</span>
			</a>
		</li>
	</ul>

	<br>

	@foreach($orders as $order)
		<div class="card rounded-0 mt-2">
			<div class="card-header bg-white">
				<div class="d-flex justify-content-between align-items-center">
						<span>
							<small class="text-muted">Transaction ID :</small> <br>
							<b>
								<a href="{{ route('order.show', $order->id) }}">#{{ $order->id }}</a>
							</b>
						</span>
						<span>
							<small class="text-muted">Order Total:</small> <br>
							Rp. {{ $order->totalPrice() }}
						</span>
					</div>
				</div>
			<div class="card-body">
				<?php $i = 1; ?>
				@foreach($order->items as $item)
					<?php $margin = ($i != 1) ? 'mt-5' : '' ?>
					<div class="d-flex bd-highlight {{ $margin }}">
						<img width="100" src="{{ url($item->Product->thumbnailUrl()) }}" alt="{{ $item->Product->name }}">

						<span class="flex-fill ml-2" style="width:100px">
							<small class="text-muted">Product</small> <br>
							{{ str_limit($item->Product->name, 20, '...') }}
						</span>
						<span class="flex-fill">
							<small class="text-muted">Seller</small> <br>
							{{ $item->Product->vendor() }}
						</span>
						<span class="flex-fill">
							<small class="text-muted">Quantity</small> <br>
							{{ $item->quantity }}
						</span>
						<span class="flex-fill">
							<small class="text-muted">Status:</small> <br>
							New
						</span>
					</div>
					<?php $i++; ?>
				@endforeach
			</div>
		</div>
	@endforeach

	<br>

	{{ $orders->links() }}

@stop