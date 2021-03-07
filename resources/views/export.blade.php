@extends('layouts.index')

@section('title','FINDER · Home')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3"><strong>Export Activites</strong></h3>
        {!! Form::model(null, [
            'route' => 'export.download',
            'method' => 'POST',
            'class' => 'needs-validation form',
            'novalidate'
        ]) !!}
        <div class="form-group">
            <label for="" class="control-label">Start</label>
            {!! Form::text('start', null, ['class'=>'form-control text-sm', 'id'=>'start', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">End</label>
            {!! Form::text('end', null, ['class'=>'form-control text-sm', 'id'=>'end', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
        </div>
        <button type="submit" class="btn btn-primary" id="btnSubmit">Export</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $("#start").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: new Date('2021/1/1'),
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate());
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
  $("#end").datepicker({
    uiLibrary: 'bootstrap4',
    locale: 'en-us',
    format: 'yyyy-mm-dd',
    weekStartDay: 1,
    disableDaysOfWeek: [0, 6],
    showOtherMonths: false,
    showOnFocus: true,
    showRightIcon: false,
    minDate: new Date('2021/1/1'),
    maxDate: function() {
        var date = new Date();
        date.setDate(date.getDate());
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    },
  });
</script>
@endpush
