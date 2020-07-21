{!! Form::model($model, [
    'route' => $model->exists ? ['tool.update', $model->id] : 'tool.store',
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
                    <label for="" class="control-label">Nama Alat</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
                    <div class="invalid-feedback" id="invalid">Please fill out this field</div>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Category</label>
                    {!! Form::select('status', $model->status, $model->statuses_id, ['class' => 'form-control', 'id' => 'statuses_id']) !!}
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Category</label>
                    {!! Form::select('lab', $model->lab, $model->labs_id, ['class' => 'form-control', 'id' => 'labs_id']) !!}
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Category</label>
                    {!! Form::select('time', $model->time, $model->times_id, ['class' => 'form-control', 'id' => 'times_id']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
                <button type="submit" class="btn btn-primary" id="modal-save"></button>
            </div>

{!! Form::close() !!}