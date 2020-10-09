{!! Form::model($model, [
    'route' => ['timeusage.createproses', $model->id],
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
        <label class="control-label">Banyak Waktu</label>
        {!! Form::text('count', null, ['class' => 'form-control', 'id' => 'count', 'required']) !!}
    </div>
    <div class="float-right" style="margin-right:5px;">
        <button type="submit" class="btn btn-primary" id="many-save">Input</button>
    </div>
</div>
{!! Form::close() !!}

<div class="modal-body" id="modal-timeusage">
{!! Form::model($model, [
    'route' => $model->exists ? ['timeusage.update', $model->id] : 'timeusage.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'class' => 'needs-validation form',
    'id' => 'proses',
    'novalidate'
]) !!}
    <div class="form-group">
        <label class="control-label">Usage</label>
        {!! Form::select('usage_id', $model->usage, $model->id, ['class' => 'form-control', 'required']) !!}
    </div>
    @for($i=0;$i<$model->count;$i++)
    <?php $times = 'time'.($i+1);?>
    <div class="form-group">
        <label class="control-label">Time {{$i+1}}</label>
        {!! Form::select($times, $model->time, $model->time_id[$i], ['class' => 'form-control', 'required']) !!}
    </div>
    @endfor
    <input id="count" type="hidden" class="form-control" name="count" value="{{$i}}">
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close2">Cancel</button>
    <button type="submit" class="btn btn-primary" id="modal-save2">Submit</button>
</div>
</div>
{!! Form::close() !!}