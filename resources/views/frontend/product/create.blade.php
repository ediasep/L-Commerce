@extends('layouts.product')

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

            <h5 class="text-uppercase font-weight-bold">{{ __('Add New Product') }}</h5>
            <br>

            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
              @csrf

              <!-- Image -->
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Product Images') }}</label>
                <div class="col-md-10">
                  <file-upload-multiple></file-upload-multiple>
                </div>
              </div>
              <!-- /Image -->

              <!-- Name -->
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
              </div>
              <!-- / Name -->

              <!-- Description -->
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                <div class="col-sm-10">
                  <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                </div>
              </div>
              <!-- / Description -->

              <!-- Price -->
              <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">{{ __('Price') }}</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                </div>
              </div>
              <!-- /Price -->

              <!-- Category -->
              <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                <div class="col-sm-10">
                  <select name="category_id" id="category" class="form-control" placeholder="Category">
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- / Category -->

              <!-- Save Button -->
              <div class="form-group row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-right btn-flat">{{ __('Save Product') }}</button>
                </div>
              </div>
              <!-- /Save Button -->

            </form>
          </div>
      </div> <!-- [End] .card -->
@endsection