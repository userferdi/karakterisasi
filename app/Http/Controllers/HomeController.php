<?php

namespace App\Http\Controllers;

use App\Approve;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                $user = Auth()->User();
                return view('home.admin', ['user'=>$user]);
            }
            else if(Auth()->User()->hasRole($client)){
                $user = Auth()->User();
                $model = Approve::whereHas('orders', function ($query){
                    return $query->where('users_id', '=', Auth()->User()->id);
                })->where(function($model){
                    $model->where('status',1)
                          ->orWhere('status',2);
                })->get();
                return view('home.client',['model'=>$model, 'user'=>$user]);
            }
        }
        else{
            return redirect()->route('login');
        }
    }

    public function welcome()
    {
        if(Auth()->User()!=NULL){
            return redirect()->route('home');
        }
        else{
            return view('welcome');
        }
    }
}
