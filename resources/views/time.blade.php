{!! Form::model($model, [
    'route' => $model->exists ? ['time.update', $model->id] : 'time.store',
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
        <label for="" class="control-label">Nama</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required', 'placeholder'=>'isi']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Waktu Start</label>
        <input id="timepicker1" class="form-control" name="time_start" value="{{$model->time_start}}"/>
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Waktu Start</label>
        <input id="timepicker2" class="form-control" name="time_end" value="{{$model->time_end}}"/>
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>
<script>
    $('#timepicker1').timepicker();
    $('#timepicker2').timepicker();
</script>

{!! Form::close() !!}