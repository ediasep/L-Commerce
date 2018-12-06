<a class="btn btn-sm btn-outline-secondary" href="{{ route($edit_route, $object->id) }}">{{ __('Edit') }}</a>
<a class="btn btn-sm btn-outline-secondary" href=""
   onclick="event.preventDefault();
                 document.getElementById('delete-form-{{$object->id}}').submit();">
    {{ __('Delete') }}
</a>

<form id="delete-form-{{$object->id}}" action="{{ route($delete_route, $object->id) }}" method="POST" style="display: none;">
	<input type="hidden" name="_method" value="delete">
	@csrf
</form>