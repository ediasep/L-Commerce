@extends('adminlte::page')

@section('content_header')
    <h4><i class="fa fa-bars"></i> &nbsp;Category</h4>
@stop

@section('content')
	
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

	<div class="box">
		<div class="box-header with-border">
			<a href="{{ route('category.create') }}" class="btn btn-primary btn-sm btn-flat">Create Category</a>
		</div>
		<div class="box-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="50px">No</th>
						<th>Name</th>
						<th>Slug</th>
						<th width="150px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->slug }}</td>
						<td>
							<a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm btn-flat">
								<i class="fa fa-edit"></i>
							</a>
							<a href="" onclick="event.preventDefault();
                                 document.getElementById('delete-form-{{$category->id}}').submit();" class="btn btn-danger btn-sm btn-flat">
								<i class="fa fa-trash"></i>
							</a>

							<form id="delete-form-{{$category->id}}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
				                  <input type="hidden" name="_method" value="delete">
				                  @csrf
				            </form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		@if($categories->hasPages())
			<div class="box-footer">
				{{ $categories->links() }}
			</div>
		@endif
	</div>
@stop