<?php

namespace App\Http\Controllers;

use App\Approve;
use Auth;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()->hasRole('Admin')){
            $user = Auth()->User();
            return view('home.admin', ['user' => Auth()->User()]);
        }
        else if(Auth()->User()->hasRole($client)){
            $model = Approve::whereHas('orders', function ($order){
                            return $order->where('users_id', '=', Auth()->User()->id);
                    })->where(function($model){
                        $model->where('status',1)
                              ->orWhere('status',2)
                              ->orWhere('status',3);
                    })->get();
            return view('home.client', ['user' => Auth()->User(), 'model' => $model]);
        }
        else{
            return redirect()->route('welcome');
        }
    }

    public function welcome()
    {
        if(Auth()->User()!=NULL){
            return redirect()->route('home');
        }
        return view('welcome');
    }
}
