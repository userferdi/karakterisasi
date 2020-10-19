<div class="btn-group" role="group">
	<button type="button" href="{{ $edit }}" class="btn btn-primary btn-sm modal-show edit" name="Edit {{ $model->name }}">Edit</button>
	<button type="button" href="{{ $delete }}" class="btn btn-danger btn-sm delete" name="{{ $model->name }}">Delete</button>
</div>