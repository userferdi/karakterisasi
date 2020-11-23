{!! Form::model($model, [
    'route' => $model->exists ? ['lab.update', $model->id] : 'lab.store',
    'method' => $model->exists ? 'PUT' : 'POST',
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
        <label for="" class="control-label">Nama Lab</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
        <!-- <div class="invalid-feedback" id="invalid">Please fill out this field</div> -->
    </div>
    <div class="form-group">
        <label for="" class="control-label">Kode Lab</label>
        {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code', 'required']) !!}
        <!-- <div class="invalid-feedback" id="invalid">Please fill out this field</div> -->
    </div>
    <div class="form-group">
        <label for="" class="control-label">Kepala Lab</label>
        {!! Form::text('head', null, ['class' => 'form-control', 'id' => 'head', 'required']) !!}
        <!-- <div class="invalid-feedback" id="invalid">Please fill out this field</div> -->
    </div>
    <div class="form-group">
        <label for="" class="control-label">Deskripsi Lab</label>
        {!! Form::textarea('descrip', null, ['class' => 'form-control', 'id' => 'descrip', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}