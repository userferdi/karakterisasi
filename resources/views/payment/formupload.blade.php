{!! Form::model($model, [
    'route' => ['payment.updateUpload',$model->id],
    'method' => 'PUT',
    'class' => 'needs-validation form',
    'files' => true,
    'novalidate'
]) !!}
@csrf
<div class="modal-header">
    <h5 class="modal-title" id="modal-title"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        &times;
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::file('image') !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}