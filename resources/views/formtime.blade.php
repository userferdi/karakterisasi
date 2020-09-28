{!! Form::model($model, [
    'route' => $model->exists ? ['timeusage.update', $model->id] : 'timeusage.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'class' => 'needs-validation',
    'id' => 'proses',
    'novalidate'
]) !!}
    <div class="form-group">
        <label class="control-label">Usage</label>
        {!! Form::select('usage_id', $model->usage, null, ['class' => 'form-control', 'required']) !!}
    </div>
    @for($i=0;$i<$model->count;$i++)
    <?php $times = 'time'.($i+1);?>
    <div class="form-group">
        <label class="control-label">Time {{$i+1}}</label>
        {!! Form::select($times, $model->time, $model->time_id[$i], ['class' => 'form-control', 'required']) !!}
    </div>
    @endfor
    <input id="count" type="hidden" class="form-control" name="count" value="{{$i}}">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>
{!! Form::close() !!}