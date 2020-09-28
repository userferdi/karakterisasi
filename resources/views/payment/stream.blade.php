<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
      span.part_1{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
      div.part_1{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
      span.part_2{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
      div.part_2{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
      span.part_3{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,204);font-weight:normal;font-style:normal;text-decoration: underline}
      div.part_3{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,204);font-weight:normal;font-style:normal;text-decoration: none}
      span.part_4{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
      div.part_4{font-family:Times,serif;font-size:14.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
      span.part_5{font-family:Times,serif;font-size:12.1px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
      div.part_5{font-family:Times,serif;font-size:12.1px;color:rgb(255,255,255);font-weight:normal;font-style:normal;text-decoration: none}
    </style>
    <script type="text/javascript" src="/var/www/html/cloud/wz_jsgraphics.js"></script>
  </head>
  <body>
<?php
$array = str_split($model->quantity);
$i=0; $j=0; $k=0; $l=0;
  foreach ($array as $char){
    if($char == ' '){
      $quantity[$k] = 0;
      for($j=$l;$j<$i;$j++){
        if(empty($quantity[$k])){
          $quantity[$k] = $array[$j];
        }
        else{
          $quantity[$k] .= $array[$j];
        }
      }
      $l=$i+1;
      $k++;
    }
    $i++;
  }
$array = str_split($model->service);
$i=0; $j=0; $k=0; $l=0;
  foreach ($array as $char){
    if($char == ' '){
      $service[$k] = 0;
      for($j=$l;$j<$i;$j++){
        if(empty($service[$k])){
          $service[$k] = $array[$j];
        }
        else{
          $service[$k] .= $array[$j];
        }
      }
      $l=$i+1;
      $k++;
    }
    $i++;
  }
?>

    <div style="
        position: absolute;
        left: 50%;
        margin-left: -306px;
        top: 0px;
        width: 612px;
        height: 792px;
        border-style: outset;
        overflow: hidden;">
      <div style="position: absolute; left: 0px; top: 0px">
        <img src="" width="612" height="792" />
      </div>
      <div style="position: absolute; left: 444px; top: 147.82px" class="part_1">
        <span class="part_1">Bandung, {{ date('d F Y', strtotime("$model->date_invoice")) }}</span>
      </div>
      <div style="position: absolute; left: 23.25px; top: 174.82px" class="part_2">
        <span class="part_2">Nomor Tagihan</span>
      </div>
      <div style="position: absolute; left: 165px; top: 174.82px" class="part_3">
        <span class="part_3"></span>
        <a href="{{ route('payment.showBill',$model->id )}}">{{ $model->no_invoice }}</a>
      </div>
      <div
        style="position: absolute; left: 23.25px; top: 190.58px"
        class="part_2"
      >
        <span class="part_2">Perihal</span>
      </div>
      <div
        style="position: absolute; left: 165px; top: 190.58px"
        class="part_1"
      >
        <span class="part_1"
          >Penagihan Penggunaan Alat {{ $model->approves->orders->tools->name }}</span
        >
      </div>
      <div
        style="position: absolute; left: 23.25px; top: 206.33px"
        class="part_2"
      >
        <span class="part_2">Lampiran</span>
      </div>
      <div
        style="position: absolute; left: 165px; top: 206.33px"
        class="part_1"
      >
        <span class="part_1">-</span>
      </div>
      <div style="position: absolute; left: 20px; top: 247.85px" class="part_2">
        <span class="part_2">Kepada Yth.,</span>
      </div>
      <div style="position: absolute; left: 20px; top: 262.25px" class="part_2">
        <span class="part_2">{{ $model->name }}</span>
      </div>
      <div style="position: absolute; left: 20px; top: 276.54px" class="part_2">
        <span class="part_2">di Tempat</span>
      </div>
      <div style="position: absolute; left: 20px; top: 302.8px" class="part_1">
        <span class="part_1"
          >Dengan ini kami informasikan tagihan Ibu/Bapak untuk penggunaan alat
          {{ $model->approves->orders->tools->name }} di Functional Nano Powder Universitas Padjadjaran.
          Selanjutnya kami sertakan nota tagihan sebagai berikut.</span>
      </div>

      <div
        style="position: absolute; left: 275.19px; top: 343.25px"
        class="part_4"
      >
        <span class="part_4">INVOICE</span>
      </div>
<!--       <div
        style="position: absolute; left: 210.29px; top: 381.36px"
        class="part_2"
      >
        <span class="part_2">Waktu</span>
      </div> -->
      <div
        style="position: absolute; /*left: 131.55px;*/ left: 181.55px; top: 395.62px"
        class="part_2"
      >
        <span class="part_2">Quantity</span>
      </div>
<!--       <div
        style="position: absolute; left: 196.28px; top: 395.62px"
        class="part_2"
      >
        <span class="part_2">Penggunaan</span>
      </div> -->
      <div
        style="position: absolute; /*left: 326.52px;*/ left: 306.52px; top: 395.62px"
        class="part_2"
      >
        <span class="part_2">Harga</span>
      </div>
      <div
        style="position: absolute; left: 406.91px; top: 395.62px"
        class="part_2"
      >
        <span class="part_2">Diskon</span>
      </div>
      <div
        style="position: absolute; left: 526.13px; top: 395.62px"
        class="part_2"
      >
        <span class="part_2">Total</span>
      </div>
<!--       <div
        style="position: absolute; left: 206.78px; top: 409.87px"
        class="part_2"
      >
        <span class="part_2">Layanan</span>
      </div> -->
      <div
        style="position: absolute; left: 31.88px; top: 442.88px"
        class="part_2"
      >
        <span class="part_2">Layanan</span>
      </div>
      <div
        style="position: absolute; left: 31.88px; top: 475.89px"
        class="part_1"
      >
        <span class="part_1">SEM SU3500</span>
      </div>
      <div
        style="position: absolute; left: 198.55px; top: 483.01px"
        class="part_1"
      >
        <span class="part_1">14</span>
      </div>
<!--       <div
        style="position: absolute; left: 205.29px; top: 483.01px"
        class="part_1"
      >
        <span class="part_1">240 menit</span>
      </div> -->
      <div
        style="position: absolute; left: 293.35px; top: 483.01px"
        class="part_1"
      >
        <span class="part_1">Rp 400.000,00</span>
      </div>
      <div
        style="position: absolute; left: 427.92px; top: 483.01px"
        class="part_1"
      >
        <span class="part_1">-</span>
      </div>
      <div
        style="position: absolute; left: 500.12px; top: 483.01px"
        class="part_1"
      >
        <span class="part_1">Rp 5.600.000,00</span>
      </div>
      <div
        style="position: absolute; left: 31.88px; top: 490.14px"
        class="part_1"
      >
        <span class="part_1">Imaging</span>
      </div>
      <div
        style="position: absolute; left: 31.88px; top: 523.15px"
        class="part_1"
      >
        <span class="part_1">Ion Sputtering :</span>
      </div>
      <div
        style="position: absolute; left: 201.55px; top: 530.28px"
        class="part_1"
      >
        <span class="part_1">2</span>
      </div>
<!--       <div
        style="position: absolute; left: 211.29px; top: 530.28px"
        class="part_1"
      >
        <span class="part_1">1 menit</span>
      </div> -->
      <div
        style="position: absolute; left: 299.35px; top: 530.28px"
        class="part_1"
      >
        <span class="part_1">Rp 50.000,00</span>
      </div>
      <div
        style="position: absolute; left: 427.92px; top: 530.28px"
        class="part_1"
      >
        <span class="part_1">-</span>
      </div>
      <div
        style="position: absolute; left: 509.12px; top: 530.28px"
        class="part_1"
      >
        <span class="part_1">Rp 100.000,00</span>
      </div>
      <div
        style="position: absolute; left: 31.88px; top: 537.4px"
        class="part_1"
      >
        <span class="part_1">Gold Coating</span>
      </div>
      <div
        style="position: absolute; left: 31.88px; top: 570.41px"
        class="part_2"
      >
        <span class="part_2">Total</span>
      </div>
      <div
        style="position: absolute; left: 498.79px; top: 570.41px"
        class="part_2"
      >
        <span class="part_2">Rp 5.700.000,00</span>
      </div>
      <div style="position: absolute; left: 20px; top: 620.44px" class="part_1">
        <span class="part_1"
          >Demikian informasi ini kami sampaikan, atas perhatian dan
          kerjasamanya, kami ucapkan terima kasih.</span
        >
      </div>
    </div>
    <div
      style="
        position: absolute;
        left: 50%;
        margin-left: -306px;
        top: 802px;
        width: 612px;
        height: 792px;
        border-style: outset;
        overflow: hidden;
      "
    >
      <div
        style="position: absolute; left: 472.85px; top: 33.9px"
        class="part_2"
      >
        <span class="part_2">ADMIN FINDER</span>
      </div>
    </div>
  </body>
</html>
