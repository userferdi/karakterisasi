<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Tool;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ScheduleController extends Controller
{
	public function index()
	{
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                return view('schedules.admin');
            }
            else if(Auth()->User()->hasRole($client)){
                return view('schedules.client');
            }
        }
        else if(Auth()->User()==NULL){
            return view('labs.index');
        }
        else{
            abort(404);
        }
	}

    public function dataindex()
    {
        $event = Schedule::where(['approves_id'=>'2'])->get();
        return json_encode($event);
    }

    public function show($id)
    {
        $model = Tool::find($id);
        return view('schedules.show', ['model' => $model]);
    }

    public function data($id)
    {
        $event = Schedule::where(['approves_id'=>'2', 'tools_id'=>$id])->get();
        return json_encode($event);
    }

    public function datatable()
    {
        $model = Tool::get();
        return DataTables::of($model)
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('schedule.show',$model->id).'" class="btn btn-primary btn-sm">Lihat Jadwal</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }
}
