@extends('layouts.index')

@section('title','FINDER · History ')

@section('content')
<h4 style="padding-top:10px;"><strong>Histori Penggunaan Alat</strong></h4>
<div class="row">
  <div class="col-lg-1">
    <table id="table" class="table table-striped table-hover table-bordered text-sm">
      <tbody>
        <tr>
            <td><a href="{{ route('history.tool') }}" class="btn btn-primary btn-sm">Tools</a></td>
            <td><a href="{{ route('history.user') }}" class="btn btn-primary btn-sm">Users</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection