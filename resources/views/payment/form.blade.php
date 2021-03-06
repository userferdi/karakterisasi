{!! Form::model($model, [
    'route' => ['payment.formBill', $model->id],
    'method' => 'GET',
    'class' => 'needs-validation',
    'id' => 'prepare',
    'novalidate'
]) !!}

<div class="modal-header">
    <h5 class="modal-title" id="modal-title"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        &times;
    </button>
</div>
<div class="modal-body" style="margin-bottom:20px;">
    <div class="form-group">
        <label class="control-label">Banyak Layanan</label>
        {!! Form::text('many', null, ['class' => 'form-control', 'id' => 'many', 'required']) !!}
    </div>
    <div class="float-right" style="margin-right:5px;">
        <button type="submit" class="btn btn-primary" id="many-save"></button>
    </div>
</div>
{!! Form::close() !!}

<div class="modal-body" id="modal-bill">

