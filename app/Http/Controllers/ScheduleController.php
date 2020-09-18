<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Lab;
use App\Order;
use App\Status;
use App\Time;
use App\Tool;
use App\Usage;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'D:\Documents\xampp\htdocs\karakterisasi\vendor\autoload.php';

class ScheduleController extends Controller
{
	public function index()
	{
        if(Auth::User()->value('role')==0){
            return view('schedules.client');
        }
        else if(Auth::User()->value('role')==1){
            return view('schedules.admin');
        }
        else {
            return redirect()->route('welcome');
        }
	}

    public function show($id)
    {
        $model = Tool::find($id);
        return view('schedules.show', ['model' => $model]);
    }

	public function dataschedule()
    {
        $event = Order::where(['approves_id'=>'2'])->get();
    	return json_encode($event);
    }

    public function data($id)
    {
        $event = Order::where(['approves_id'=>'2', 'tools_id'=>$id])->get();
        return json_encode($event);
    }

    public function tokenRequest($token)
    {
        $model = Order::where('token', $token)->update([
            'token' => NULL,
            'verif' => 2,
        ]);
    }

    public function verifyRequest($token)
    {
        $model = Order::where('token', $token)->update([
            'token' => NULL,
            'verif' => 2,
        ]);
    }

}
