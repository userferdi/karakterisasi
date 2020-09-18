<?php

namespace App\Http\Controllers;

use App\Booking;

use Auth;
// use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $model = Booking::where('token', $token)->first();
        // dd($model->orders->unique);
        if($model->status == 1){
            return view('verify.myself', ['model' => $model]);
        }
        else if($model->status == 2){
            return view('verify.student', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function confirm($token)
    {
        $model = Booking::where('token', $token)->get();
        $model = $model[0];
       if($model['status']==1){
            if($model->orders->users->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){
                $newtoken = str::random(60);
                $save = Booking::where('token', $token)->update([
                    'token' => $newtoken,
                    'status' => 2,
                ]);
                if($save == true){
                    $mail = new PHPMailer(true);
                    try{
                        // $mail->SMTPOptions = array(
                        //     'ssl' => array(
                        //         'verify_peer' => false,
                        //         'verify_peer_name' => false,
                        //         'allow_self_signed' => true
                        //     )
                        // );
                        // $mail->SMTPDebug = 2;
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
                        // echo 'Message has been sent!';
                    }catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                }
            }
            else if($model->orders->users->hasRole('Dosen Unpad|Dosen Non Unpad|User Umum')){
                $save = Booking::where('token', $token)->update([
                    'token' => NULL,
                    'status' => 3,
                ]);
		        return redirect()->route('verify.success');
            }
            else{
                abort(404);
            }
        }
        else if($model['status']==2){
            $model = Booking::where('token', $token)->update([
                'token' => NULL,
                'status' => 3,
            ]);
	        return redirect()->route('verify.success');
        }
        else{
            abort(404);
        }
    }

    public function reject($token)
    {
        $model = Booking::where('token', $token)->get();
        $model = $model[0];
        if($model['status']==1){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 4,
	            'statuses_id' => 5,
	        ]);
	        return redirect()->route('verify.success');
        }
        else if($model['status']==2){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 4,
	            'statuses_id' => 3,
	        ]);
            return redirect()->route('verify.success');
        }
        else if($model['status']==3){
	        $save = Booking::where('token', $token)->update([
	            'token' => NULL,
	            'status' => 4,
	            'statuses_id' => 4,
	        ]);
            return redirect()->route('verify.success');
        }
    }

    public function success()
    {
        return view('verify.success');
    }
}
