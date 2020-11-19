@extends('layouts.list')

@section('title', 'FINDER · Price List')

@section('content')
<div style="padding:40px; margin-top:135px">
  <div class="table-responsive">
    @foreach($tool as $t)
      <?php $i = 1;?>
      <h3 class="panel-title mb-3"><strong>{{$t->name}}</strong></h3>
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th class="text-center" width="40%">Service</th>
            <th class="text-center" width="20%">Satuan</th>
            <th class="text-center" width="20%">Harga Unpad</th>
            <th class="text-center" width="20%">Harga Umum</th>
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
              </tr>
              <?php $i++;?>
            @endif
          @endforeach
        </tbody>
      </table>
      <br>
    @endforeach
  </div>
</div>
@endsection