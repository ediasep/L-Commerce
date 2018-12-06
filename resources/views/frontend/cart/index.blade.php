@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 text-muted text-center">
			<h5 class="mb-3">
				&nbsp;
				<i class="fa fa-shopping-cart"></i>
				<b>{{ __('CART') }}</b>
			</h5>
			<hr class="my-3">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(count($items) > 0)
				<div class="card rounded-0 mb-2">
					<div class="card-body bg-white">
						<div class="font-weight-bold text-success">
							<span style="display:inline-block; width:25px">#</span>
							<span style="display:inline-block; width:120px">Image</span>
							<span style="display:inline-block; width:450px">Name</span>
							<span style="display:inline-block; width:110px">Quantity</span>
							<span style="display:inline-block; width:160px">Action</span>
							<span style="width:100px">Price</span>
						</div>
					</div>
				</div>

				@foreach($items as $item)
					<div class="card rounded-0 mb-1">
						<div class="card-body bg-white">
							<div class="font-weight-bold text-muted">
								<span style="display:inline-block; width:25px">
									{{ $item->id }}
								</span>

								<span style="display:inline-block; width:120px">
									<img src="{{ $item->options->image_url }}" width="100" />
								</span>

								<span style="display:inline-block; width:440px">
									{{ $item->name }}
								</span>

								<div style="display:inline-block; width:110px;">
				      				<input type="text" style="width:80px; border: 1px solid #ddd; padding: 5px; text-align: center;"  value="{{ $item->qty }}" onchange="event.preventDefault(); document.getElementById('qty-{{$item->id}}').value = this.value" />
								</div>

								<span style="display:inline-block; width:160px; padding-top: 5px;">
							      	<a href="{{ route('cart.update', $item->rowId) }}" class="btn btn-sm btn-outline-secondary" onclick="event.preventDefault();
							      										document.getElementById('update-form-{{$item->id}}').submit();">
							      									{{ __('Update') }}
							      								</a>

					                <form id="update-form-{{$item->id}}" action="{{ route('cart.update', $item->rowId) }}" method="POST" style="display: none;">
					                    @csrf
					                    <input id="qty-{{$item->id}}" type="hidden" name="qty" value="{{ $item->qty }}">
					                    <input type="hidden" name="_method" value="put">
					                </form>

							      	<a href="{{ route('cart.destroy', $item->rowId) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash-alt"></i></a>

								</span>
								<span style="width:100px">
									$ {{ $item->price }}
								</span>
							</div>
						</div>
					</div>
				@endforeach

				<div class="card rounded-0 mt-2">
					<div class="card-body bg-white">
						<div class="font-weight-bold text-muted">
							<span style="display:inline-block; width:870px">Sub Total</span>
							<span style="display:inline-block; width:120px">$ {{ Cart::subtotal() }}</span>
						</div>
					</div>
				</div>

				<div class="card rounded-0 mt-1">
					<div class="card-body bg-white">
						<div class="font-weight-bold text-muted">
							<span style="display:inline-block; width:870px">Tax</span>
							<span style="display:inline-block; width:120px">$ {{ Cart::tax() }}</span>
						</div>
					</div>
				</div>

				<div class="card rounded-0 mt-1">
					<div class="card-body bg-white">
						<div class="font-weight-bold text-muted">
							<span style="display:inline-block; width:870px">Total</span>
							<span style="display:inline-block; width:120px">$ {{ Cart::total() }}</span>
						</div>
					</div>
				</div>
			@else
				<h4 class="text-muted mt-5 mb-5 text-center">{{ __('There is no item in the cart') }}</h4>
				<div class="mt-5 mb-5">&nbsp;</div>
			@endif
		</div>
	</div>

	@if(count($items) > 0)
		<div class="row mt-3">
			<div class="col-md-12 text-center">
				<a href="{{ route('cart.empty') }}" class="btn btn-outline-secondary btn-flat btn-lg waves-effect">{{ __('Empty Cart') }}</a>
				<a href="{{ route('cart.checkout') }}" class="btn btn-lg btn-primary btn-flat waves-effect">{{ __('Checkout') }}</a>
			</div>
		</div>
	@endif
</div>

@endsection
