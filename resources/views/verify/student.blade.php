@extends('layouts.verify')

@section('title', 'FINDER')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h3 class="text-center" style="padding-bottom:15px;"><strong>Verifikasi Penggunaan Alat</strong></h3>
        <p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light"></thead>
          <tbody>
            <tr>
                <td width="35%">Nama Mahasiswa:</td>
                <td width="65%">{{$model->orders->users->name}}</td>
            </tr>
            <tr>
                <td>NIM:</td>
                <td>{{$model->orders->users->profiles->no_id}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$model->orders->users->email}}</td>
            </tr>
            <tr>
                <td>Study Program:</td>
                <td>{{$model->orders->users->profiles->study_program}}</td>
            </tr>
            <tr>
                <td>Faculty:</td>
                <td>{{$model->orders->users->profiles->faculty}}</td>
            </tr>
            <tr>
                <td>University:</td>
                <td>{{$model->orders->users->profiles->university}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
          </tbody>
        </table>
        <p>Anda diminta untuk melakukan verifikasi sebagai Dosen Penanggungjawab terhadap permintaan penggunaan alat dari Mahasiswa tersebut.</p>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light"></thead>
          <tbody>
            <tr>
                <td width="35%">Penggunaan Alat:</td>
                <td width="65%">{{$model->orders->tools->name}}</td>
            </tr>
            <tr>
                <td>Tanggal dan Waktu Pilihan 1:</td>
                <td>{{$model->date1}}, {{$model->times1->name}}</td>
            </tr>
            <tr>
                <td>Tanggal dan Waktu Pilihan 2:</td>
                <td>{{$model->date2}}, {{$model->times2->name}}</td>
            </tr>
            <tr>
                <td>Tanggal dan Waktu Pilihan 3:</td>
                <td>{{$model->date3}}, {{$model->times3->name}}</td>
            </tr>
<!--             <tr>
                <td>Tanggal dan Waktu:</br>
                    <div class="float-right">
                      Pilihan 1:</br>
                      Pilihan 2:</br>
                      Pilihan 3:</br>
                    </div>
                </td>
                <td></br>
                    {{$model->date1}}, {{$model->times1->name}}</br>
                    {{$model->date2}}, {{$model->times2->name}}</br>
                    {{$model->date3}}, {{$model->times3->name}}</br>
                </td>
            </tr> -->
            <tr>
                <td>Tujuan Pengamatan:</td>
                <td>{{$model->orders->purpose}}</td>
            </tr>
            <tr>
                <td>Deskripsi Sample:</td>
                <td>{{$model->orders->sample}}</td>
            </tr>
            <tr>
                <td>Preparasi Khusus:</td>
                <td>{{$model->orders->unique}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
          </tbody>
        </table>
        <div class="float-right">
          <a href="{{route('verify.confirm',$model->token)}}" class="btn btn-primary btn-sm edit modal-show center" name="$model->title">Confirm</a>
          <a href="{{route('verify.reject',$model->token)}}" class="btn btn-danger btn-sm edit modal-show center" name="$model->title">Reject</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3"></div>
</div>
@endsection

@push('scripts')
@endpush