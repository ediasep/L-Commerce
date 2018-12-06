@extends('layouts.setting')

@section('section')

	@if ($errors->any())
	  <div class="alert alert-danger">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	      <ul>
	          @foreach ($errors->all() as $error)
	              <li>{{ $error }}</li>
	          @endforeach
	      </ul>
	  </div>
	@endif

	<div class="card rounded-0">
		<div class="card-body">
            <h5 class="text-uppercase font-weight-bold">{{ __('Account') }}</h5>
            <br>
		    <form method="post" action="{{ route('account.update', $user->id) }}">
		      @csrf

			  <input type="hidden" name="_method" value="put">

		      <div class="form-group row">
		        <label for="name" class="col-sm-3 col-form-label">{{ __('Name') }}</label>
		        <div class="col-sm-9">
		          <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}" />
		        </div>
		      </div>

		      <div class="form-group row">
		        <label for="email" class="col-sm-3 col-form-label">{{ __('Email') }}</label>
		        <div class="col-sm-9">
		          <input type="text" class="form-control-plaintext" id="email" name="email" placeholder="Email" value="{{ $user->email }}" disabled />
		        </div>
		      </div>

		      <div class="form-group row">
		        <label for="password" class="col-sm-3 col-form-label">{{ __('New Password') }}</label>
		        <div class="col-sm-9">
		          <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('New Password') }}" />
		        </div>
		      </div>

		      <div class="form-group row">
		        <label for="password_confirmation" class="col-sm-3 col-form-label">{{ __('Repeat New Password') }}</label>
		        <div class="col-sm-9">
		          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Repeat New Password') }}" />
		        </div>
		      </div>

              <!-- Save Button -->
              <div class="form-group row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-right btn-flat">{{ __('Update Account') }}</button>
                </div>
              </div>
              <!-- /Save Button -->

			</form>
        </div>
    </div>
@endsection
