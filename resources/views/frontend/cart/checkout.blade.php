@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 text-muted text-center">
			<h5 class="mb-3">
				&nbsp;
				<i class="fa fa-credit-card"></i>
				<b>{{ __('CHECKOUT') }}</b>
			</h5>
			<hr>
		</div>
	</div>
	<form action="{{ route('order.store') }}" method="post">
		<div class="row">
			@csrf
			<div class="col-md-6">

				@auth
				<div class="card rounded-0">
					<div class="card-body">
			            <h5 class="text-uppercase font-weight-bold">{{ __('Shipping Address') }}</h5>
			            <hr>

						<address-picker />
					</div>
				</div>
				@endauth	

				@guest
				<div class="card rounded-0">
					<div class="card-body">
			            <h5 class="text-uppercase font-weight-bold">{{ __('Address') }}</h5>
			            <hr>
			            <div class="form-group row">
			            	<div class="col-md-12">
								<label for="address_name" class="col-form-label">{{ __('Address Name') }}</label>
								<input type="text" class="form-control" id="address_name" name="address_name" value="" placeholder="Address Name">
			            	</div>
			            </div>

						<div class="form-group row">
							<div class="col-md-6">
								<label for="first_name" class="col-form-label">{{ __('First Name') }}</label>
								<input type="text" class="form-control" id="first_name" name="first_name" value="" placeholder="First Name">
							</div>

							<div class="col-md-6">
								<label for="last_name" class="col-form-label">{{ __('Last Name') }}</label>
								<input type="text" class="form-control" id="last_name" name="last_name" value="" placeholder="Last Name">
							</div>

						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label for="email" class="col-form-label">{{ __('Email Address') }}</label>
								<input type="text" class="form-control" id="email" name="email" value="" placeholder="Email Address">
							</div>

							<div class="col-md-6">
								<label for="phone" class="col-form-label">{{ __('Phone Number') }}</label>
								<input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Phone Number">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="full_address" class="col-form-label">{{ __('Address') }}</label>
								<textarea name="full_address" class="form-control" cols="30" rows="2" placeholder="Address"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="suburb_or_town" class="col-form-label">{{ __('Suburb / Town') }}</label>
								<input type="text" class="form-control" id="suburb_or_town" name="suburb_or_town" value="" placeholder="Suburb / Town">
							</div>						
						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label for="state_or_territory" class="col-form-label">{{ __('State / Teritory') }}</label>
								<input type="text" class="form-control" id="state_or_territory" name="state_or_territory" value="" placeholder="State / Teritory">
							</div>
							<div class="col-md-6">
								<label for="post_code" class="col-form-label">{{ __('Post Code') }}</label>
								<input type="text" class="form-control" id="post_code" name="post_code" value="" placeholder="Post Code">
							</div>				
						</div>
			            <br>
					</div>
				</div>
				@endguest

				<div class="card rounded-0 mt-2">
					<div class="card-body">
			            <h5 class="text-uppercase font-weight-bold">{{ __('Shipping Method') }}</h5>
						<hr>
			            <div class="form-group">
			            	<div class="d-flex justify-content-between align-items-center">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="shipping" id="exampleRadios2" value="option2" checked>
								  <label class="form-check-label" for="exampleRadios2">
								    Regular (1 - 6 weeks, no tracking)
								  </label>
								  <br>
								  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore illo reiciendis quasi nulla, repudiandae, ipsam velit.</p>
								</div>

								<b>$8</b>
							</div>
						</div>

			            <div class="form-group">
			            	<div class="d-flex justify-content-between align-items-center">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="shipping" id="exampleRadios2" value="option2">
								  <label class="form-check-label" for="exampleRadios2">
								    Express (2 - 8 days, tracking)
								  </label>
								  <br>
								  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore illo reiciendis quasi nulla, repudiandae, ipsam velit.</p>
								</div>

								<b>$14</b>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card rounded-0">
					<div class="card-body">
			            <h5 class="text-uppercase font-weight-bold">{{ __('Payment Method') }}</h5>
			            <hr>
			            <div class="form-group">
			            	<div class="d-flex justify-content-between align-items-center">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="payment" id="payment2" value="option2" checked>
								  <label class="form-check-label" for="payment2">
								    Credit Card
								  </label>
								</div>

								<h2>
									<i class="fab fa-cc-mastercard"></i>
									<i class="fab fa-cc-visa"></i>
								</h2>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="name" class="col-form-label">{{ __('Credit Card Number') }}</label>
								<input type="text" class="form-control" id="name" name="name" value="" placeholder="Credit Card Number">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label for="name" class="col-form-label">{{ __('Expiry Date') }}</label>
								<input type="text" class="form-control" id="name" name="name" value="" placeholder="MM">
							</div>
							<div class="col-md-6">
								<label for="name" class="col-form-label">&nbsp;</label>
								<input type="text" class="form-control" id="name" name="name" value="" placeholder="YY">
							</div>				
						</div>

						<div class="form-group row">
							<div class="col-md-6">
								<label for="name" class="col-form-label">{{ __('Credit Card Verification Number') }}</label>
								<input type="text" class="form-control" id="name" name="name" value="" placeholder="Credit Card Number">
							</div>
						</div>

			            <div class="form-group">
			            	<div class="d-flex justify-content-between align-items-center">
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="payment" id="payment2" value="option2">
								  <label class="form-check-label" for="payment2">
								    Paypal Express Checkout
								  </label>
								</div>

								<h2>
									<i class="fab fa-cc-paypal"></i>
								</h2>
							</div>
						</div>
			            <br>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card rounded-0 mt-2">
					<div class="card-body">
						<h5 class="text-uppercase font-weight-bold">{{ __('Review Your Order') }}</h5>
						<hr>

						@if(count($items) > 0)
							<table class="table bg-white table-bordered">
							  <tbody>
							  	@foreach($items as $key => $item)

							  	<input type="hidden" name="order_items[{{$key}}][product_id]" value="{{ $item->id }}">
							  	<input type="hidden" name="order_items[{{$key}}][quantity]" value="{{ $item->qty }}">

							    <tr>
							      <td>
							      	{{ $item->name }}
							      </td>
							      <td width="20%">
							      	<input type="number" class="form-control" value="{{ $item->qty }}" onchange="event.preventDefault();
							      		document.getElementById('qty-{{$item->id}}').value = this.value">
							      </td>

							      <td width="30%">$ {{ $item->price }}</td>
							    </tr>
							    @endforeach

							    <tr class="font-weight-bold">
							    	<td colspan="2">{{ __('Sub Total') }}</td>
							    	<td>$ {{ Cart::subtotal() }}</td>
							    </tr>

							    <tr class="font-weight-bold">
							    	<td colspan="2">{{ __('Total') }}</td>
							    	<td>$ {{ Cart::total() }}</td>
							    </tr>

							  </tbody>
							</table>
						@endif
					</div>
				</div>

				<button class="btn btn-primary btn-block btn-flat btn-lg mt-5">{{ __('Place Order') }}</button>
			</div>
		</div>
	</form>
</div>

@stop