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
            else if($model->status == 3){
                return redirect()->route('status.booking');
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
                $newtoken = str::random(60);
                $save = Booking::where('token', $token)->update([
                    'token' => $newtoken,
                    'status' => 2,
                ]);
                if($model->orders->users->profiles->email_lecturer!=NULL){
                    if($save == true){
                        $mail = new PHPMailer(true);
                        try{
                            $mail->Encoding = 'base64';
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'functionalnanopowder@gmail.com';
                            $mail->Password = '1w3r!W#R';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;
                            $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                            $mail->AddAddress($model->orders->users->profiles->email_lecturer);
                            $mail->Subject = 'Verifikasi Booking Alat';
                            $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Dosen Pembimbing terhadap pemesanan booking alat dari Mahasiswa tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('student.booking').'">Login!</a></p>
<p>Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
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
                        $mail->Username = 'functionalnanopowder@gmail.com';
                        $mail->Password = '1w3r!W#R';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                        $mail->AddAddress('support.finder@unpad.ac.id');
                        $mail->Subject = 'Confirm Booking Alat';
                        if($model->orders->users->hasRole('User Umum')){
                            $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari User Umum tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                        }
                        else{
                            $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Dosen tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                        }
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
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress('support.finder@unpad.ac.id');
                    $mail->Subject = 'Confirm Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    $mail->isHTML(true);
                    $mail->Send();
                    return redirect()->route('verify.success');
                }catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }
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
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Reject Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda ditolak oleh Dosen Pembimbing</p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Reject List</b> dengan link berikut: <a href="'.route('status.rejected').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
            return redirect()->route('verify.success');
        }
        else if($model['status']==3){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 8,
                'note' => $request->note,
	        ]);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Reject Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda ditolak oleh Admin</p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Reject List</b> dengan link berikut: <a href="'.route('status.rejected').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
            return redirect()->route('verify.success');
        }
    }

    public function cancel(Request $request, $token)
    {
        $model = Booking::where('token', $token)->first();
        if($model['status']==1){
            $save = Booking::where('token', $token)->update([
                'token' => NULL,
                'status' => 9,
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
        if($model->status == 2){
            if(Auth()->user()->email == $model->orders->users->profiles->email_lecturer){
                
                return view('verify.formreject', ['model' => $model]);
            }
        }
        if($model->status == 3){
            if(Auth()->User()->hasRole('Admin')){
                
                return view('verify.formreject', ['model' => $model]);
            }
        }
        else{
            abort(404);
        }
    }

    public function updateConfirm(Request $request, $id)
    {
        $model = Booking::find($id);
        if($model->status == 2){
            $newtoken = str::random(60);
            $save = Booking::find($id)->update([
                'token' => $newtoken,
                'status' => 3,
            ]);
            $model = Booking::find($id);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress('support.finder@unpad.ac.id');
                $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('login').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
                return response()->json(true);
            }catch (Exception $e) {
                return response()->json(error);
            }
        }
        else if($model->status == 3){
            $booking = $request->all();
            $booking['token'] = NULL;
            $booking['status'] = 4;
            $booking = Booking::findOrFail($id)->update($booking);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Konfirmasi Jadwal Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda telah dikonfirmasi oleh Admin.</p>
<p>Harap untuk melakukan konfirmasi jadwal yang telah ditetapkan oleh Admin dengan link berikut: <a href="'.route('status.confirmation').'">di sini!</a>.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
                return response()->json(true);
            }catch (Exception $e) {
                return response()->json(error);
            }
        }
        else if($model->status == 4){
            $save = Booking::find($id)->update([
                'status' => 6,
            ]);
            if($model->datetime == 1){
                $date = date('d M Y', strtotime($model->date1)).' '.$model->times1->name;
            }
            else if($model->datetime == 2){
                $date = date('d M Y', strtotime($model->date2)).' '.$model->times2->name;
            }
            else if($model->datetime == 3){
                $date = date('d M Y', strtotime($model->date3)).' '.$model->times3->name;
            }
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress('support.finder@unpad.ac.id');
                $mail->Subject = 'Konfirmasi Booking Alat';
                if($model->orders->users->hasRole('User Umum')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>konfirmasi</b> penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk mempersiapkan penggunaan alat sesuai dengan jadwal.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else if($model->orders->users->hasRole('Dosen Unpad')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>konfirmasi</b> penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk mempersiapkan penggunaan alat sesuai dengan jadwal.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else{
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>konfirmasi</b> penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk mempersiapkan penggunaan alat sesuai dengan jadwal.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }

                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
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

            $no = Approve::whereHas('orders', function ($query) use ($model){
                return $query->where('tools_id', '=', $model->orders->tools->id);
            })->get('id')->count();
            $no+=1;
            $no_regis = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code;
            $title = $no_regis.': '.$model->orders->users->name;
            $save = Approve::create([
                'orders_id' => $model->orders_id,
                'no_regis' => $no_regis,
                'date' => $date,
                'times_id' => $time,
                'status' => 1
            ]);
            $save = Schedule::create([
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
            $booking = $request->all();
            $booking['status'] = 5;
            $booking = Booking::findOrFail($id)->update($booking);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Reschedule Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Pemesanan penggunaan alat Anda akan dilakukan reschedule.</p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Reschedule Offered List</b> dengan link berikut: <a href="'.route('status.reschedule').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
                return response()->json(true);
            }catch (Exception $e) {
                return response()->json(error);
            }
        }
        else if($model->status == 5){
            $token = str::random(60);
            $booking = $request->all();
            $booking['token'] = $token;
            $booking['status'] = 1;
            $booking = Booking::findOrFail($id)->update($booking);
            if($model == true){
                $mail = new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress(Auth()->User()->email);
                    $mail->Subject = 'Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari Anda.</p><br>
<p>Sebelum melanjutkan proses pemesanan, kami perlu memastikan bahwa ini memang Anda. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$token).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Booking Request</b> dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json(true);
                }catch (Exception $e) {
                    return response()->json(error);
                }
            }
        }
        else{
            abort(404);
        }
    }

    public function updateReject(Request $request, $id)
    {
        $model = Booking::find($id);
        if($model->status == 2){
            $booking = $request->all();
            $booking['token'] = NULL;
            $booking['status'] = 8;
            $booking = Booking::findOrFail($id)->update($booking);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Reject Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda ditolak oleh Dosen Pembimbing</p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Reject List</b> dengan link berikut: <a href="'.route('status.rejected').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
            return response()->json($booking);
        }
        if($model->status == 3){
            $booking = $request->all();
            $booking['token'] = NULL;
            $booking['status'] = 8;
            $booking = Booking::findOrFail($id)->update($booking);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Reject Booking Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda ditolak oleh Admin</p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Reject List</b> dengan link berikut: <a href="'.route('status.rejected').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
            return response()->json($booking);
        }
        else{
            abort(404);
        }
    }

    public function updateCancel($id)
    {
        $model = Booking::find($id);
        $booking = Booking::find($id)->update([
            'token' => NULL,
            'status' => 9,
        ]);
        if($model->status!=1){
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress('support.finder@unpad.ac.id');
                $mail->Subject = 'Cancel Booking Alat';
                if($model->orders->users->hasRole('User Umum')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembatalan</b> penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p><br>
<p>Anda sebagai Admin tidak perlu mempersiapkan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else if($model->orders->users->hasRole('Dosen Unpad')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembatalan</b> penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p><br>
<p>Anda sebagai Admin tidak perlu mempersiapkan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else{
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembatalan</b> penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p><br>
<p>Anda sebagai Admin tidak perlu mempersiapkan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
        }
        return response()->json($booking);
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
                try{
                    $mail->CharSet = 'UTF-8';
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress($model->orders->users->email);
                    $mail->Subject = 'Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari Anda.</p><br>
<p>Sebelum melanjutkan proses pemesanan, kami perlu memastikan bahwa ini memang Anda. Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$newtoken).'">di sini!</a></p>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dan masuk ke menu <b>My Activities -> Booking Request</b> dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json(true);
                }catch (Exception $e) {
                    return response()->json(error);
                }
            }
        }
        else if($model['status']==2){
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
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress($model->orders->users->profiles->email_lecturer);
                    $mail->Subject = 'Verifikasi Booking Alat';
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Dosen Pembimbing terhadap pemesanan penggunaan alat dari Mahasiswa tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('student.booking').'">Login!</a></p>
<p>Apabila Anda tidak melakukan verifikasi maka mahasiswa Anda tidak dapat melanjutkan proses permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json(true);
                }catch (Exception $e) {
                    return response()->json(error);
                }
            }
        }
        else if($model['status']==3){
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
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->SetFrom('functionalnanopowder@gmail.com');
                    $mail->AddAddress('support.finder@unpad.ac.id');
                    $mail->Subject = 'Confirm Booking Alat';
                    if($model->orders->users->roles[0]->name=='Dosen Unpad'||$model->orders->users->roles[0]->name=='Dosen Non Unpad'){
                        $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Dosen tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    }
                    else if($model->orders->users->roles[0]->name=='Mahasiswa Unpad'||$model->orders->users->roles[0]->name=='Mahasiswa Non Unpad'){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari Mahasiswa tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    }
                    else if($model->orders->users->roles[0]->name=='User Umum'){
                        $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima permintaan penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p><br>
<p>Anda diminta untuk melakukan verifikasi sebagai Admin terhadap permintaan penggunaan alat dari User Umum tersebut. Untuk melihat detail pemesanan dan melakukan verifikasi silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">Login!</a></p>
<p>Silahkan Masuk ke Menu <b>Client Activities -> Booking Request</b> untuk melihat detail pemesanan dan melakukan verifikasi terhadap permintaan penggunaan alat.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                    }
                    else{
                        abort(404);
                    }
                    $mail->isHTML(true);
                    $mail->Send();
                    return response()->json(true);
                }catch (Exception $e) {
                    return response()->json(error);
                }
            }
        }
    }

}
