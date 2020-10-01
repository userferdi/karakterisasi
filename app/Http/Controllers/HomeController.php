<?php

namespace App\Http\Controllers;

use App\Approve;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user=Auth()->User();
        if($user!=NULL){
            if($user->hasRole('Admin')){
                return view('home.admin', ['user'=>$user]);
            }
            $model = Approve::whereHas('orders', function ($query){
                return $query->where('users_id', '=', Auth()->User()->id);
            })->where(function($model){
                $model->where('status',1)
                    ->orWhere('status',2);
            })->get();
            $cek = $model->first();
            return view('home.client', ['user'=>$user, 'model'=>$model]);
        }
        return redirect()->route('welcome');
    }

    public function welcome()
    {
        if(Auth()->User()!=NULL){
            return redirect()->route('home');
        }
        return view('welcome');
    }
}
