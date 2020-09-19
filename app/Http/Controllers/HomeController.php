<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                return view('home.admin');
            }
            else if(Auth()->User()->hasRole($client)){
                return view('home.client');
            }
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
