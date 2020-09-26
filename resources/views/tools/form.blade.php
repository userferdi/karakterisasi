{!! Form::model($model, [
    'route' => $model->exists ? ['tool.update', $model->id] : 'tool.store',
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
        <label class="control-label">Nama Alat</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Kode Alat</label>
        {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Deskripsi Alat</label>
        {!! Form::textarea('descrip', null, ['class' => 'form-control', 'id' => 'descrip', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Preparasi Sampel</label>
        {!! Form::textarea('sample', null, ['class' => 'form-control', 'id' => 'sample', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label class="control-label">Status</label>
        {!! Form::select('actives_id', $model->actives, $model->actives_id, ['class' => 'form-control', 'id' => 'actives_id', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Laboratorium</label>
        {!! Form::select('labs_id', $model->labs, $model->labs_id, ['class' => 'form-control', 'id' => 'labs_id', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Waktu Penggunaan</label>
        {!! Form::select('usages_id', $model->usages, $model->usages_id, ['class' => 'form-control', 'id' => 'usages_id', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Upload Image</label><br>
        {!! Form::file('image') !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}