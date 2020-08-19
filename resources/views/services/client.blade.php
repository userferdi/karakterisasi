@extends('layouts.client')

@section('title','FINDER · Price List')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <h3 class="panel-title mb-3"><strong>Price List</strong></h3>
    <div class="card">
      <div class="card-body">
        @foreach($tool as $t)
          <h5 class="panel-title mb-3"><strong>{{$t->name}}</strong></h5>
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th class="text-center" width="10%">No</th>
                <th class="text-center" width="40%">Service</th>
                <th class="text-center" width="30%">Harga</th>
                <th class="text-center" width="20%">Diskon</th>
              </tr>
            </thead>
            <tbody>
              @foreach($service as $s)
                @if($t->id == $s->tools_id)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $s->name }}</td>
                    <td class="text-center">Rp {{ number_format($s->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $s->discount }}%</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
          </br>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection