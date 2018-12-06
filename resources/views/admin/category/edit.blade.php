@extends('adminlte::page')

@section('content_header')
    <h4><i class="fa fa-bars"></i> &nbsp;Edit Category</h4>
@stop

@section('content')
<form action="{{ route('category.update', $category->id) }}" method="POST">
	@csrf

	<input type="hidden" name="_method" value="put">

	<div class="box">
		<div class="box-body">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" placeholder="Name" value="{{ $category->name }}" />
			</div>

			<div class="form-group">
				<label>Slug</label>
				<input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ $category->slug }}" />
			</div>
		</div>

		<div class="box-footer">
			<input type="submit" value="Update Category" class="btn btn-primary btn-flat pull-right" />
		</div>
	</div>
</form>
@stop