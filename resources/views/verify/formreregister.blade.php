{!! Form::model($booking, [
    'route' => ['verify.updateReschedule', $booking->id],
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
    <label class="control-label">Tanggal dan Waktu</label>
    <div class="form-group">
        <label class="control-label">Pilihan 1</label>
        {!! Form::text('date1', null, ['class'=>'form-control text-sm', 'id'=>'datepicker1', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
        {!! Form::select('times1_id', $booking->time, null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Pilihan 2</label>
        {!! Form::text('date2', null, ['class'=>'form-control text-sm', 'id'=>'datepicker2', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
        {!! Form::select('times2_id', $booking->time, null, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Pilihan 3</label>
        {!! Form::text('date3', null, ['class'=>'form-control text-sm', 'id'=>'datepicker3', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
        {!! Form::select('times3_id', $booking->time, null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <!-- {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'modal-save']) !!} -->
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

<script>
  $("#datepicker1").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
  $("#datepicker2").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
  $("#datepicker3").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: function() {
            var date = new Date();
            date.setDate(date.getDate()+7);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate()+34);
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
</script>

{!! Form::close() !!}