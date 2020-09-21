{!! Form::model($model, [
    'route' => ['verify.updateReschedule', $model->id],
    'method' => 'PUT',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}

<div class="modal-header">
    <h5 class="modal-title" id="modal-title"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        &times;
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label class="control-label">Catatan</label>
        {!! Form::text('note', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <!-- {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'modal-save']) !!} -->
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}