@extends('layouts.index')

@section('title', 'FINDER')

@section('content')
<h3 style="padding-top:10px;"><strong>Formulir Penggunaan Alat</strong></h3>
{!! Form::model($model, [
    'route' => 'activities.store',
    'method' => 'POST',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}
<div class="row text-sm" style="padding-left:15px;padding-right:15px;">
    <div class="col-lg-6" style="padding-right:15px;">
        <div class="form-group">
            <label for="" class="control-label">Alat</label>
            {!! Form::select('tools_id', $model->tool, null, ['class' => 'form-control text-sm']) !!}
        </div>
        <label for="" class="control-label">Tanggal dan Waktu</label>
        <div class="form-group">
            <label for="" class="control-label">Pilihan 1</label>
            {!! Form::text('date1', null, ['class'=>'form-control text-sm', 'id'=>'datepicker1', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
            {!! Form::select('times1_id', $model->time, null, ['class' => 'form-control text-sm']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Pilihan 2</label>
            {!! Form::text('date2', null, ['class'=>'form-control text-sm', 'id'=>'datepicker2', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
            {!! Form::select('times2_id', $model->time, null, ['class' => 'form-control text-sm']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Pilihan 3</label>
            {!! Form::text('date3', null, ['class'=>'form-control text-sm', 'id'=>'datepicker3', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
            {!! Form::select('times3_id', $model->time, null, ['class' => 'form-control text-sm']) !!}
        </div>
        <div class="form-group" style="padding-left:20px;">
            {!! Form::checkbox('attend', null, 0, ['class'=>'form-check-input']) !!}
            <label class="form-check-label" for="nameInput">Apakah Pengguna Alat Hadir saat penggunaan alat?<sup> (1)</sup></label>
            <p>(uncheck bila sampel dititipkan)</p>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Rencana Pembayaran</label>
            {!! Form::select('plans_id', $model->plan, null, ['class' => 'form-control text-sm']) !!}
        </div>
    </div>
    <div class="col-lg-6" style="padding-left:15px;">
        <div class="form-group">
            <label for="" class="control-label">Tujuan</label>
            {!! Form::textarea('purpose', null, ['class'=>'form-control text-sm', 'rows'=>'6', 'required', 'placeholder'=>'Tuliskan tujuan pengamatan Anda']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Deskripsi Sampel</label><sup> (2)</sup>
            {!! Form::textarea('sample', null, ['class'=>'form-control text-sm', 'rows'=>'6', 'id'=>'sample', 'required', 'placeholder'=>'Deskripsikan dengan jelas mengenai sampel: ukuran partikel, kandungan unsur, dan yang lainnya.']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Preparasi Khusus</label><sup> (3)</sup>
            {!! Form::textarea('unique', null, ['class'=>'form-control text-sm', 'rows'=>'6', 'id'=>'unique', 'required', 'placeholder'=>'Sampel yang membutuhkan preparasi khusus wajib dikonsultasikan terlebih dahulu dengan pihak Print-G']) !!}
        </div>
    </div>
    <div class="col-lg-12">
        </br><sup>(1)</sup> Apabila pengguna tidak hadir pada saat pengamatan, wajib melampirkan referensi yang diinginkan. Keluhan tidak kami terima apabila pengguna satu minggu setelah pengamatan selesai (apabila hadir) atau pada saat pengamatan (apabila tidak hadir).</br>
        <sup>(2)</sup> Menyadari bahwa penggunaan peralatan memerlukan biaya perawatan yang akan dibebankan pada dosen pembimbing.</br>
        <sup>(3)</sup> Sampel yang membutuhkan preparasi khusus wajib dikonsultasikan terlebih dahulu dengan pihak FiNder. Lampirkan jurnal rujukan dan tahapan preparasinya apabila dibutuhkan.</br></br>
    </div>
    <div class="col-lg-12 text-center">
        <div class="form-aggrement">
            <p>“Dengan ini saya menyetujui pemilihan metode untuk sampel yang akan dikarakterisasi telah sesuai, kesalahan pemilihan metode karakterisasi dan jumlah pengambilan data adalah tanggung jawab saya sendiri.”</p>
            <p style="color:red">* Jadwal akan diinformasikan setiap hari jumat maksimal pukul 11.00 WIB</p>
            {!! Form::checkbox('', null, 0, ['class'=>'form-aggrement-input', 'id'=>'hadir', 'onchange'=>'agree()']) !!}
            <label class="form-aggrement-label" for="form-aggrement-input">Setuju</label></br></br>
            <button type="submit" class="btn btn-primary" id="btnSubmit" disabled="true">Tambah</button>
        </div>
    </div>
</div></br>
{!! Form::close() !!}
@endsection

@push('scripts')
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

  function agree(){
    if(document.getElementById('btnSubmit').disabled == true ){
      document.getElementById('btnSubmit').disabled = false;
    }
    else{
      document.getElementById('btnSubmit').disabled = true;
    }
  };
</script>
@endpush