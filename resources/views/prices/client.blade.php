@extends('layouts.index')

@section('title','FINDER · Price List')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <h3 class="panel-title mb-3"><strong>Price List</strong></h3>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          @foreach($tool as $t)
            <?php $i = 1;?>
            <h5 class="panel-title mt-6 mb-3"><strong>{{$t->name}}</strong></h5>
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="text-center" width="32.5%">Service</th>
                  <th class="text-center" width="20%">Satuan</th>
                  <th class="text-center" width="17.5%">Harga Unpad</th>
                  <th class="text-center" width="17.5%">Harga Umum</th>
                  <th class="text-center" width="10%">Diskon</th>
                </tr>
              </thead>
              <tbody>
                @foreach($price as $s)
                  @if($t->id == $s->tools_id)
                    <tr>
                      <td>{{ $s->service }}</td>
                      <td class="text-center">{{ $s->unit }}</td>
                      <td class="text-center">Rp {{ number_format($s->price1, 0, ',', '.') }}</td>
                      <td class="text-center">Rp {{ number_format($s->price3, 0, ',', '.') }}</td>
                      <td class="text-center">{{ $s->discount }}%</td>
                    </tr>
                    <?php $i++;?>
                  @endif
                @endforeach
              </tbody>
            </table>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection