@extends('layouts.product')

@section('section')
  	<h5 class="text-uppercase font-weight-bold mb-3">
	  	{{ __('Transaction Details') }}
	  	#{{$order->id}}
  	</h5>

	<div class="card rounded-0 mt-2">
		<div class="card-header">
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

					<span class="flex-fill ml-2"  style="width:100px">
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
						<small class="text-muted">Price:</small> <br>
						Rp. {{ $item->Product->price * $item->quantity }}
					</span>
				</div>
				<?php $i++; ?>
			@endforeach
		</div>
	</div>

	<div class="card rounded-0 mt-2">
		<div class="card-header">
			{{ __('Billing Address') }}
		</div>
		<div class="card-body">
			<div class="d-flex justify-content-between align-items-center">
				<b>First Name</b>
				{{ $order->BillingAddress->first_name }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Last Name</b>
				{{ $order->BillingAddress->last_name }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Email</b>
				{{ $order->BillingAddress->email }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Phone</b>
				{{ $order->BillingAddress->phone }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Suburb / Town</b>
				{{ $order->BillingAddress->suburb_or_town }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>State / Territory</b>
				{{ $order->BillingAddress->state_or_territory }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Postcode</b>
				{{ $order->BillingAddress->post_code }}
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<b>Full Address</b>
				{{ $order->BillingAddress->full_address }}
			</div>
		</div>
	</div>
@stop