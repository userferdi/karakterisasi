@extends('layouts.verify')

@section('title', 'FINDER')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h3 class="text-center" style="padding-bottom:15px;"><strong>Verifikasi Penggunaan Alat</strong></h3>
        <p>Functional Nano Powder (FINDER) menerima permintaan penggunaan alat dari:</p>
        <table id="table" class="table row-border hover order-column text-sm">
          <thead class="thead-light"></thead>
          <tbody>
            <tr>
                <td width="35%">Nama:</td>
                <td width="65%">{{$model->orders->users->name}}</td>
            </tr>
            <tr>
                @if($model->orders->users->hasRole('Dosen Unpad|Dosen Non Unpad'))
                    <td>NIDN:</td>
                @elseif($model->orders->users->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad'))
                    <td>NIM:</td>
                @elseif($model->orders->users->hasRole('User Umum'))
                    <td>ID Number:</td>
                @endif
                <td>{{$model->orders->users->profiles->no_id}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{$model->orders->users->email}}</td>
            </tr>
            @if($model->orders->users->hasRole('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad'))
                <tr>
                    <td>Program Studi:</td>
                    <td>{{$model->orders->users->profiles->study_program}}</td>
                </tr>
                <tr>
                    <td>Fakultas:</td>
                    <td>{{$model->orders->users->profiles->faculty}}</td>
                </tr>
                <tr>
                    <td>Universitas:</td>
                    <td>{{$model->orders->users->profiles->university}}</td>
                </tr>
            @elseif($model->orders->users->hasRole('User Umum'))
                <tr>
                    <td>Lembaga:</td>
                    <td>{{$model->orders->users->profiles->institution}}</td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td>{{$model->orders->users->profiles->address}}</td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
            </tr>
          </tbody>
        </table>
        <p>Anda mengajukan permintaan penggunaan alat dengan rincian sebagai berikut:</p>
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
                <td>Pengguna Hadir saat Penggunaan Alat:</td>
                <td>
                    @if($model->orders->attend=='on')
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-times"></i>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Rencana Pembayaran:</td>
                <td>{{$model->orders->plans->name}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
          </tbody>
        </table>
        <div class="float-right">
            <a href="{{ route('verify.confirm',$model->token) }}" class="btn btn-primary btn-sm" onclick="event.preventDefault(); document.getElementById('confirm').submit();">Confirm</a>
            <form id="confirm" action="{{ route('verify.confirm',$model->token) }}" method="PUT" style="display: none;">
                <input id="status" type="hidden" class="form-control" name="status" value="confirm">
            </form>
            <a href="{{ route('verify.cancel',$model->token) }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('cancel').submit();">Cancel</a>
            <form id="cancel" action="{{ route('verify.cancel',$model->token) }}" method="PUT" style="display: none;">
                <input id="status" type="hidden" class="form-control" name="status" value="cancel">
            </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3"></div>
</div>
@endsection

@push('scripts')
@endpush