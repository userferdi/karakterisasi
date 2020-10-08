{!! Form::model($model, [
    'route' => $model->exists ? ['price.update', $model->id] : 'price.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'files' => true,
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
        <label class="control-label">Alat</label>
        {!! Form::select('tools_id', $model->tool, $model->tools_id, ['class' => 'form-control', 'id' => 'tool', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Service</label>
        {!! Form::text('service', null, ['class' => 'form-control', 'id' => 'service', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Harga untuk User Unpad</label>
        {!! Form::text('price1', null, ['class' => 'form-control', 'id' => 'price1', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Harga untuk User Non Unpad</label>
        {!! Form::text('price2', null, ['class' => 'form-control', 'id' => 'price2', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Harga untuk User Umum</label>
        {!! Form::text('price3', null, ['class' => 'form-control', 'id' => 'price3', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Diskon</label>
        {!! Form::text('discount', null, ['class' => 'form-control', 'id' => 'discount', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}