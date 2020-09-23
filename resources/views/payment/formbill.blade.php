{!! Form::model($model, [
    'route' => ['payment.updateBill', $model->id],
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
    @for($i=0;$i<$model->many;$i++)
    <?php $service = 'service'.($i+1); $quantity = 'quantity'.($i+1);?>
    <div class="form-group">
        <label class="control-label">Layanan {{$i+1}}</label>
        {!! Form::select($service, $model->service, null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Kuantitas</label>
        {!! Form::text($quantity, null, ['class' => 'form-control', 'id' => '', 'required']) !!}
        <div class="invalid-feedback" id="invalid">Please fill out this field</div>
    </div>
    @endfor
    <input id="many" type="hidden" class="form-control" name="many" value="{{$i}}">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

{!! Form::close() !!}