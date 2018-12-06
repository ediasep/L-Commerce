@extends('layouts.setting')

@section('section')
  <div class="card rounded-0">
      <div class="card-body">
        <h5 class="text-uppercase font-weight-bold">{{ __('Shop') }}</h5>
        <br>
        <form method="post" action="{{ route('shop.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Shop Logo') }}</label>
            <div class="col-sm-10">
              <file-upload></file-upload>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
          </div>

          <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
            <div class="col-sm-10">
              <textarea name="description" id="description" class="form-control" placeholder="{{ __('Description') }}"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-flat float-right">{{ __('Save') }}</button>
            </div>
          </div>

        </form>
      </div>
  </div>
@endsection
