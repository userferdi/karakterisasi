<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class ExportController extends Controller
{
    public function index()
    {
        if(Auth()->User()->hasRole('Admin')){
            return view('export');
        }
        else{
        	abort(404);
        }
    }

    public function download(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
	    	$schedules = Schedule::whereBetween('start', [$request->start, $request->end])->get();
			foreach($schedules as $i=>$schedule){
	            $model[$i]['No'] = $i+1;
	            $model[$i]['No Formulir'] = $schedule->orders->bookings->no_form;
	            $model[$i]['No Registrasi'] = $schedule->orders->approves->no_regis;
	            if($schedule->orders->approves->payments()->exists()){
		            $model[$i]['No Invoice'] = $schedule->orders->payments->no_invoice;
		            $model[$i]['No Receipt'] = $schedule->orders->payments->no_receipt;
	            }
	            else{
		            $model[$i]['No Invoice'] = null;
		            $model[$i]['No Receipt'] = null;
	            }
	            $model[$i]['Nama Pengguna'] = $schedule->orders->users->name;
	            $model[$i]['Alat'] = $schedule->orders->tools->name;
	            $model[$i]['Tujuan'] = $schedule->orders->purpose;
	            $model[$i]['Deskripsi Sampel'] = $schedule->orders->sample;
	            $model[$i]['Preparasi Khusus'] = $schedule->orders->unique;
	            $model[$i]['Start'] = $schedule->start;
	            $model[$i]['End'] = $schedule->end;
	        }
	        $sheets = new SheetCollection([
	            $model,
	        ]);
	        return (new FastExcel($sheets))->download('file.xlsx');
        }
        else{
        	abort(404);
        }
    }
}
