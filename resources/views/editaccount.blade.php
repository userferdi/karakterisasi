{!! Form::model($model, [
    'route' => ['account.update', $model->id],
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
        <label for="" class="control-label">E-mail Address</label>
        {!! Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>
{!! Form::close() !!}