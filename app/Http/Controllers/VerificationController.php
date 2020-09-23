<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Booking;
use App\Schedule;
use App\Time;
use App\Tool;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $model = Booking::where('token', $token)->first();
        if($model!=NULL){
            if($model->status == 1){
                return view('verify.myself', ['model' => $model]);
            }
            else if($model->status == 2){
                return view('verify.student', ['model' => $model]);
            }
        }
        else{
            abort(404);
        }
    }

    public function confirm(Request $request, $token)
    {
        $model = Booking::where('token', $token)->first();
        if($model['status']==1){
            if($model->orders->users->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){
                if($model->orders->users->profiles->email_lecturer!=NULL){
                    $newtoken = str::random(60);
                    $save = Booking::where('token', $token)->update([
                        'token' => $newtoken,
                        'status' => 2,
                    ]);
                    if($save == true){
                        $mail = new PHPMailer(true);
                        try{
                            $mail->Encoding = 'base64';
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'ferdi.maulana@gmail.com';
                            $mail->Password = 'oiuuiookmmko';
                            // SSL: 465, TLS: 587
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 465;
                            $mail->SetFrom('ferdi.maulana@gmail.com', 'Admin');
                            $mail->AddAddress($model->orders->users->profiles->email_lecturer);
                            $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                            $mail->Body = '
    <p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p><br/>
    <p>Nama Mahasiswa : <strong>'.$model->orders->users->name.'</strong></p>
    <p>NIM : <strong>'.$model->orders->users->profiles->no_id.'</strong></p>
    <p>Email : <strong>'.$model->orders->users->email.'</strong></p>
    <p>Program Studi : <strong>'.$model->orders->users->profiles->study_program.'</strong></p>
    <p>Fakultas : <strong>'.$model->orders->users->profiles->faculty.'</strong></p>
    <p>Universitas : <strong>'.$model->orders->users->profiles->university.'</strong></p><br/>
    <p>Anda diminta untuk melakukan verifikasi sebagai Dosen Penanggungjawab terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
    <p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('student.status').'">login!</a></p>
    <p>Silahkan Masuk ke Menu <strong>My Students -> Booking Request</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda. Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat di PPNN ITB.</p><br/><br/>
    <p>Hormat Kami,</p><br/>
    <p>Sekretariat SIPA FINDER</p>
    <p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
    ';
                            $mail->isHTML(true);
                            $mail->Send();
                            return redirect()->route('verify.success');
                        }catch (Exception $e) {
                            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                        }
                    }
                }
                else{
                    return redirect()->route('verify.success');
                }
            }
            else{
                $newtoken = str::random(60);
                $save = Booking::where('token', $token)->update([
                    'token' => $newtoken,
                    'status' => 3,
                ]);
                if($save == true){
                    $mail = new PHPMailer(true);
                    try{
                        $mail->Encoding = 'base64';
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'ferdi.maulana@gmail.com';
                        $mail->Password = 'oiuuiookmmko';
                        // SSL: 465, TLS: 587
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->SetFrom('ferdi.maulana@gmail.com', 'Admin');
                        $mail->AddAddress('ferdi.maulana@gmail.com');
                        $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                        $mail->Body = '
<p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p><br/>
<p>Nama Mahasiswa : <strong>'.$model->orders->users->name.'</strong></p>
<p>NIM : <strong>'.$model->orders->users->profiles->no_id.'</strong></p>
<p>Email : <strong>'.$model->orders->users->email.'</strong></p>
<p>Program Studi : <strong>'.$model->orders->users->profiles->study_program.'</strong></p>
<p>Fakultas : <strong>'.$model->orders->users->profiles->faculty.'</strong></p>
<p>Universitas : <strong>'.$model->orders->users->profiles->university.'</strong></p><br/>
<p>Anda diminta untuk melakukan verifikasi sebagai Dosen Penanggungjawab terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('student.status').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Students -> Booking Request</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda. Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat di PPNN ITB.</p><br/><br/>
<p>Hormat Kami,</p><br/>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                        $mail->isHTML(true);
                        $mail->Send();
                        return redirect()->route('verify.success');
                    }catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                }
            }
        }
        else if($model['status']==2){
            $newtoken = str::random(60);
            $model = Booking::where('token', $token)->update([
                'token' => $newtoken,
                'status' => 3,
            ]);
            if($save == true){
                $mail = new PHPMailer(true);
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ferdi.maulana@gmail.com';
                    $mail->Password = 'oiuuiookmmko';
                    // SSL: 465, TLS: 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('ferdi.maulana@gmail.com', 'Admin');
                    $mail->AddAddress('ferdi.maulana@gmail.com');
                    $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p><br/>
<p>Nama Mahasiswa : <strong>'.$model->orders->users->name.'</strong></p>
<p>NIM : <strong>'.$model->orders->users->profiles->no_id.'</strong></p>
<p>Email : <strong>'.$model->orders->users->email.'</strong></p>
<p>Program Studi : <strong>'.$model->orders->users->profiles->study_program.'</strong></p>
<p>Fakultas : <strong>'.$model->orders->users->profiles->faculty.'</strong></p>
<p>Universitas : <strong>'.$model->orders->users->profiles->university.'</strong></p><br/>
<p>Anda diminta untuk melakukan verifikasi sebagai Dosen Penanggungjawab terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('student.status').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Students -> Booking Request</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda. Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat di PPNN ITB.</p><br/><br/>
<p>Hormat Kami,</p><br/>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                    $mail->isHTML(true);
                    $mail->Send();
                    return redirect()->route('verify.success');
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }
        // else if($model['status']==3){
        //     $model = Booking::where('token', $token)->update([
        //         'token' => NULL,
        //         'status' => 4,
        //     ]);
        // }
        else{
            abort(404);
        }
    }

    public function reject(Request $request, $token)
    {
        $model = Booking::where('token', $token)->first();
        if($model['status']==1){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 9,
	        ]);
	        return redirect()->route('verify.success');
        }
        else if($model['status']==2){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 7,
                'note' => $request->note,
	        ]);
            return redirect()->route('verify.success');
        }
        else if($model['status']==3){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 8,
                'note' => $request->note,
	        ]);
            return redirect()->route('verify.success');
        }
    }

    public function showConfirm($id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            $datetime = collect(new Booking);
            $time = Time::find($model->times1_id)->name;
            $datetime[1] = new Booking;
            $datetime[1]['id'] = 1;
            $datetime[1]['datetime'] = $model->date1.' '.$time;
            $time = Time::find($model->times2_id)->name;
            $datetime[2] = new Booking;
            $datetime[2]['id'] = 2;
            $datetime[2]['datetime'] = $model->date2.' '.$time;
            $time = Time::find($model->times3_id)->name;
            $datetime[3] = new Booking;
            $datetime[3]['id'] = 3;
            $datetime[3]['datetime'] = $model->date3.' '.$time;

            $model['datetime'] = $datetime->pluck('datetime','id');
            return view('verify.formconfirm', ['model' => $model]);
        }
        else if($model->status == 5){
            return view('verify.formconfirm', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function showReschedule($id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            return view('verify.formreschedule', ['model' => $model]);
        }
        if($model->status == 5){
            $booking = new Booking;
            $booking['id'] = $id;
            $booking['time'] = Time::leftJoin('time_usage', 'time_usage.time_id', '=', 'times.id')
                ->where('usage_id',$model->orders->tools->usages_id)->pluck('name','times.id');
            return view('verify.formreregister', ['booking' => $booking]);
        }
        else{
            abort(404);
        }
    }

    public function showReject($id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            return view('verify.formreject', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function updateConfirm(Request $request, $id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            $model = $request->all();
            $model['status'] = 4;
            $model = Booking::findOrFail($id)->update($model);
            return response()->json($model);
        }
        else if($model->status == 4){
            $save = Booking::find($id)->update([
                'status' => 6,
            ]);
            if($model->datetime == 1){
                $date = $model->date1;
                $time = $model->times1_id;
            }
            else if($model->datetime == 2){
                $date = $model->date2;
                $time = $model->times2_id;
            }
            else if($model->datetime == 3){
                $date = $model->date3;
                $time = $model->times3_id;
            }
            $time_start = Time::where('id',$time)->value('time_start');
            $start = date('Y-m-d H:i:s', strtotime("$date $time_start"));
            $time_end = Time::where('id',$time)->value('time_end');
            $end = date('Y-m-d H:i:s', strtotime("$date $time_end"));

            // dd($model->orders->tools->code);
            $tool = Tool::where('id',$request->tools_id)->first();
            $no = Schedule::orderBy('id', 'desc')->value('id');
            if($no == NULL){
                $no = 1;
                $no_regis = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code;
            }
            else{
                $no+=1;
                $no_regis = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code;
            }
            $title = $no_regis.': '.$model->orders->users->name;
            // dd($start);
            $save = Approve::insert([
                'orders_id' => $model->orders_id,
                'no_regis' => $no_regis,
                'date' => $date,
                'times_id' => $time,
                'status' => 1
            ]);
            $save = Schedule::insert([
                'orders_id' => $model->orders_id,
                'title' => $title,
                'start' => $start,
                'end' => $end
            ]);

            return response()->json($save);
        }
        else{
            abort(404);
        }
    }

    public function updateReschedule(Request $request, $id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            $model = $request->all();
            $model['status'] = 5;
            $model = Booking::findOrFail($id)->update($model);
            return response()->json($model);
        }
        if($model->status == 5){
            $token = str::random(60);
            $model = $request->all();
            $model['token'] = $token;
            $model['status'] = 1;
            $model = Booking::findOrFail($id)->update($model);
            if($model == true){
                $mail = new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ferdi.maulana@gmail.com';
                    $mail->Password = 'oiuuiookmmko';
                    // SSL: 465, TLS: 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('ferdi.maulana@gmail.com', 'Ferdian Maulana');
                    $mail->AddAddress(Auth()->User()->email);
                    $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                    $mail->Body = '
<p>Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari Anda.</p>
<p>Sebelum melanjutkan proses pemesanan, kami perlu memastikan bahwa ini memang Anda.</p>
<p>Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$token).'">di sini!</a></p><br/>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Activities -> Registration of Tool Usage</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda.</p>
<p>Jika bukan Anda yang melakukan transaksi tersebut, harap mengabaikan pesan ini.</p><br/><br/>
<p>Hormat Kami,</p>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json($model);
                    // return redirect()->route('status.booking');
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function updateReject(Request $request, $id)
    {
        $model = Booking::find($id);
        if($model->status == 3){
            $model = $request->all();
            $model['status'] = 8;
            $model = Booking::findOrFail($id)->update($model);
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function updateCancel($id)
    {
        $model = Booking::find($id)->update([
            'token' => NULL,
            'status' => 9,
        ]);
        return response()->json($model);
    }

    public function success()
    {
        return view('verify.success');
    }

    public function resend($id)
    {
        $model = Booking::find($id);
        if($model['status']==1){
            $newtoken = str::random(60);
            $save = Booking::find($id)->update([
                'token' => $newtoken,
            ]);
            if($save == true){
                $mail = new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
                try{
                    $mail->Encoding = 'base64';
                    // Auth()->User()->email
                    // $model->users->email
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ferdi.maulana@gmail.com';
                    $mail->Password = 'oiuuiookmmko';
                    // SSL: 465, TLS: 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('ferdi.maulana@gmail.com', 'Ferdian Maulana');
                    $mail->AddAddress($model->orders->users->email);
                    $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari Anda.</p>
<p>Sebelum melanjutkan proses pemesanan, kami perlu memastikan bahwa ini memang Anda. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p><br/>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Activities -> Registration of Tool Usage</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda.</p>
<p>Jika bukan Anda yang melakukan transaksi tersebut, harap mengabaikan pesan ini.</p><br/><br/>
<p>Hormat Kami,</p><br/>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json($save);
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }
        else if($model['status'==2]){
            $newtoken = str::random(60);
            $save = Booking::find($id)->update([
                'token' => $newtoken,
            ]);
            if($save == true){
                $mail = new PHPMailer(true);
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ferdi.maulana@gmail.com';
                    $mail->Password = 'oiuuiookmmko';
                    // SSL: 465, TLS: 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('ferdi.maulana@gmail.com', 'Admin');
                    $mail->AddAddress($model->orders->users->profiles->email_lecturer);
                    $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p><br/>
<p>Nama Mahasiswa : <strong>'.$model->orders->users->name.'</strong></p>
<p>NIM : <strong>'.$model->orders->users->profiles->no_id.'</strong></p>
<p>Email : <strong>'.$model->orders->users->email.'</strong></p>
<p>Program Studi : <strong>'.$model->orders->users->profiles->study_program.'</strong></p>
<p>Fakultas : <strong>'.$model->orders->users->profiles->faculty.'</strong></p>
<p>Universitas : <strong>'.$model->orders->users->profiles->university.'</strong></p><br/>
<p>Anda diminta untuk melakukan verifikasi sebagai Dosen Penanggungjawab terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('student.status').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Students -> Booking Request</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda. Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat di PPNN ITB.</p><br/><br/>
<p>Hormat Kami,</p><br/>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json($save);
                    // return redirect()->route('verify.success');
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }
        else if($model['status'==3]){
            $newtoken = str::random(60);
            $save = Booking::find($id)->update([
                'token' => $newtoken,
            ]);
            if($save == true){
                $mail = new PHPMailer(true);
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ferdi.maulana@gmail.com';
                    $mail->Password = 'oiuuiookmmko';
                    // SSL: 465, TLS: 587
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('ferdi.maulana@gmail.com');
                    $mail->AddAddress('ferdi.maulana@gmail.com');
                    $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Alat (SIPA) Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari:</p><br/>
<p>Nama Mahasiswa : <strong>'.$model->orders->users->name.'</strong></p>
<p>NIM : <strong>'.$model->orders->users->profiles->no_id.'</strong></p>
<p>Email : <strong>'.$model->orders->users->email.'</strong></p>
<p>Program Studi : <strong>'.$model->orders->users->profiles->study_program.'</strong></p>
<p>Fakultas : <strong>'.$model->orders->users->profiles->faculty.'</strong></p>
<p>Universitas : <strong>'.$model->orders->users->profiles->university.'</strong></p><br/>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('student.status').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Students -> Booking Request</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda. Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat di PPNN ITB.</p><br/><br/>
<p>Hormat Kami,</p><br/>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>
';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json($save);
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }
    }

}
