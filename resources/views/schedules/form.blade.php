{!! Form::model($model, [
    'route' => 'schedule.store',
    'method' => 'POST',
    'class' => 'needs-validation form',
    'novalidate'
]) !!}
<div class="row text-sm" style="padding-left:15px;padding-right:15px;">
    <div class="col-lg-6" style="padding-right:15px;">
        <div class="form-group">
            <label for="" class="control-label">Alat</label>
            {!! Form::select('tools_id', $model->tool, $model->tool_id, ['class' => 'form-control text-sm']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Tanggal dan Waktu</label>
            {!! Form::text('date', null, ['class'=>'form-control text-sm', 'id'=>'datepicker', 'required', 'placeholder'=>'yyyy-mm-dd']) !!}
            {!! Form::select('times_id', $model->time, $model->time_id, ['class' => 'form-control text-sm']) !!}
        </div>
        <div class="form-group">
            <label for="" class="control-label">Tujuan</label>
            {!! Form::textarea('purpose', null, ['class'=>'form-control text-sm', 'rows'=>'4', 'required', 'placeholder'=>'Tuliskan tujuan pengamatan Anda']) !!}
        </div>
        <div class="form-group" style="padding-left:20px;">
            {!! Form::checkbox('attend', null, 0, ['class'=>'form-check-input']) !!}
            <label class="form-check-label" for="nameInput">Apakah Pengguna Alat Hadir saat penggunaan alat?<sup> (1)</sup></label>
            <p>(uncheck bila sampel dititipkan)</p>
        </div>
    </div>
    <div class="col-lg-6" style="padding-left:15px;">
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
        <sup>(3)</sup> Sampel yang membutuhkan preparasi khusus wajib dikonsultasikan terlebih dahulu dengan pihak PPNN. Lampirkan jurnal rujukan dan tahapan preparasinya apabila dibutuhkan.</br></br>
    </div>
    <div class="col-lg-12 text-center">
        <div class="form-aggrement">
            <p>“Dengan ini saya menyetujui pemilihan metode untuk sampel yang akan dikarakterisasi telah sesuai, kesalahan pemilihan metode karakterisasi dan jumlah pengambilan data adalah tanggung jawab saya sendiri.”</p>
            <p style="color:red">* Jadwal akan diinformasikan setiap hari jumat maksimal pukul 11.00 WIB</p>
            <!-- <input class="form-aggrement-input" onchange="agree()" type="checkbox" value="yes"> -->
            {!! Form::checkbox('', null, 0, ['class'=>'form-aggrement-input', 'id'=>'hadir', 'onchange'=>'agree()']) !!}
            <label class="form-aggrement-label" for="form-aggrement-input">Setuju</label></br></br>
            <button type="submit" class="btn btn-primary" id="btnSubmit" disabled="true">Tambah</button>
        </div>
    </div>
</div></br>

<!-- <button id="btnSubmit" type="submit" class="btn btn-primary" disabled="true">Tambah</button> -->


{!! Form::close() !!}