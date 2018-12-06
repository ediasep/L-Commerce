@extends('layouts.setting')

@section('section')
  <div class="card rounded-0">
      <div class="card-body">
        <h5 class="text-uppercase font-weight-bold">{{ __('Shop') }}</h5>
        <br>
        <form method="post" action="{{ route('shop.update', $shop->id) }}" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="put">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Shop Logo') }}</label>
            <div class="col-sm-10">
              <file-upload image="{{ $shop->logo }}"></file-upload>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $shop->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
            <div class="col-sm-10">
              <textarea name="description" id="description" class="form-control" rows="5" placeholder="Description">{{ $shop->description }}</textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-flat float-right">{{ __('Update') }}</button>
            </div>
          </div>
        </form>
      </div>
  </div>
@endsection
