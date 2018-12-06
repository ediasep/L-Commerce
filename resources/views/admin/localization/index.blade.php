@extends('adminlte::page')

@section('content_header')
    <h4><i class="fa fa-flag"></i> Localization Setting</h4>
@stop

@section('content')

<form method='post' action="{{ route('admin.localizationsetting.update', $localization_setting->id) }}" class="form-horizontal">
	@csrf

	<input type="hidden" name="_method" value="put">

	<div class="box">
	  <!-- /.box-header -->
	  <div class="box-body">
		<div class="form-group row">
			<label class="col-md-1 control-label">Language</label>
			<div class="col-md-5">
				<input type="text" name="language" class="form-control" placeholder="Language" value="{{ $localization_setting->language }}" />
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-1 control-label">Currency</label>
			<div class="col-md-5">
				<input type="text" name="currency" class="form-control" placeholder="Currency" value="{{ $localization_setting->currency }}" />
			</div>
		</div>
	  </div>
	  <!-- /.box-body -->
	  <div class="box-footer">
	    <input type="submit" class="btn btn-primary btn-flat pull-right" value="Update Setting">
	  </div>
	  <!-- box-footer -->
	</div>
	<!-- /.box -->
</form>
@endsection