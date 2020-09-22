<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $model=Auth()->User();
        if($model!=NULL){
            if($model->hasRole('Admin')){
                return view('home.admin', ['model'=>$model]);
            }
            return view('home.client', ['model'=>$model]);
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
