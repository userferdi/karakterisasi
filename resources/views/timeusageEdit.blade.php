{!! Form::model($model, [
    'route' => $model->exists ? ['timeusage.update', $model->id] : 'timeusage.store',
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
        <label for="" class="control-label">Waktu Penggunaan Alat</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
<!--     <div class="form-group">
        <label class="control-label">Nama Waktu</label>
        {!! Form::select('usage_id', $model->usage, null, ['class' => 'form-control', 'required']) !!}
    </div> -->
    <div class="form-group">
        <label class="control-label">Waktu</label><br>
        <select multiple id="select" type="text" class="js-states form-control" name="time[]" style="width: 100%">
            @foreach($time as $option)
            <option value="{{$option->id}}" {{ in_array($option->id, $model->selected) ? 'selected="selected"' : null }}>{{$option->name}}</option>
            @endforeach
        </select>
        <script>
            $("#select").select2({
                placeholder: "Pilih Waktu",
                theme: "classic",
                width: "resolve"
            })
        </script>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close2">Cancel</button>
    <button type="submit" class="btn btn-primary" id="modal-save2">Submit</button>
</div>
{!! Form::close() !!}