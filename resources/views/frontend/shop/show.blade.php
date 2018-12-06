@extends('layouts.app')

@section('content')
<!--Jumbotron-->
<div class="jumbotron">

	<div class="container">
		<div class="row mt-3">
			@if($shop->logo)
				<div class="col-md-2">
					<div class="card p-1">
						<!-- Logo -->
						<img class="img-fluid" src="{{ $shop->logo }}" alt="">
					</div>
				</div>
			@endif
			<div class="col-md-10">
			    <!--Title-->
			    <h1 class="card-title h2-responsive"><strong>{{ $shop->name }}</strong></h1>
			    <!--Text-->
			    <p class="text-muted mb-3" style="max-width: 43rem;">{{ str_limit($shop->description, 300, '...') }}</p>
			</div>
		</div>
	</div>

</div>
<!--Jumbotron-->

<div class="container">
    <div class="row">
		@foreach($shop->user->products as $product)
			<div class="col-md-4 mb-5">
				@include('component.product_thumbnail')
			</div>
		@endforeach
    </div>
</div>
@endsection
