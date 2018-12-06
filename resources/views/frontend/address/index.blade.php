@extends('layouts.setting')

@section('section')
<div class="card rounded-0">
	<div class="card-body">

		<div class="d-flex w-100 justify-content-between">
			<h5 class="text-uppercase font-weight-bold">{{ __('Addresses') }}</h5>

			<a href="{{ route('address.create') }}" class="btn btn-primary btn-sm btn-flat">
				<span class="fa fa-plus-circle"></span> {{ __('Add Address') }}
			</a>
		</div>

		<br>

		<div class="list-group mb-3 ">
		  @foreach($addresses as $address)
			  <li href="#" class="list-group-item list-group-item-action flex-column align-items-start rounded-0">
			    <div class="d-flex w-100 justify-content-between">
			      <span>
				      <b class="mb-1">
				      	{{ $address->address_name }}
				      </b>

				      @if($address->is_main_address)
						<span class="badge badge-primary">Main Address</span>
					  @endif
				  </span>

	              <div>
	              	@if(!$address->is_main_address)
						<a class="btn btn-sm btn-outline-secondary" href=""
						   onclick="event.preventDefault();
						                 document.getElementById('setmain-form-{{$address->id}}').submit();">
						    {{ __('Set as Main') }}
						</a>

						<form id="setmain-form-{{$address->id}}" action="{{ route('address.set_main_address', $address->id) }}" method="POST" style="display: none;">
							<input type="hidden" name="_method" value="put">
							@csrf
						</form>
					@endif


					@include(
						'component.listcontrol', 
						[
							'object' => $address,
							'edit_route' => 'address.edit',
							'delete_route' => 'address.destroy'
						]
					)
				  </div>
			    </div>
			    <p class="mb-1 text-muted" style="max-width: 550px">{{ $address->full_address }}</p>
			    <small>{{ $address->post_code }}</small>
			  </li>
		  @endforeach
		</div>
		
		{{ $addresses->links() }}
	</div>
</div>
@endsection