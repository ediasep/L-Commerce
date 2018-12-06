@extends('adminlte::page')

@section('content_header')
    <h4><i class="fa fa-bars"></i> &nbsp;Create Category</h4>
@stop

@section('content')
<form action="{{ route('category.store') }}" method="POST">
	@csrf

	<div class="box">
		<div class="box-body">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" placeholder="Name" />
			</div>

			<div class="form-group">
				<label>Slug</label>
				<input type="text" name="slug" class="form-control" placeholder="Slug" />
			</div>
		</div>

		<div class="box-footer">
			<input type="submit" value="Save Category" class="btn btn-primary btn-flat pull-right" />
		</div>
	</div>
</form>
@stop