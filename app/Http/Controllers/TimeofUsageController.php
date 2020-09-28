<?php

namespace App\Http\Controllers;

use App\Time;
use App\Usage;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeofUsageController extends Controller
{
    public function createPrepare()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Usage();
            $model['usage'] = Usage::pluck('name','id');
            return view('formusage', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function createProses(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Usage();
            $model['usage_id'] = $request->usage_id;
            $model['count'] = $request->count;
            $model['usage'] = Usage::pluck('name','id');
            $model['time'] = Time::pluck('name','id');
            return view('formtime', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($request->usage_id);
			for($i=0;$i<$request->count;$i++){
				$time = 'time'.($i+1);
				$time = $request->$time;
				$model = DB::table('time_usage')->insert([
					'usage_id' => $request->usage_id,
					'time_id' => $time
				]);
			}
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($id);
            $i=0;
            foreach($model->times as $a){
				$b[$i] = $a->id;
        		$i++;
            }
            $model['time_id'] = $b;
            $model['count'] = $i;
            $model['usage'] = Usage::pluck('name','id');
            $model['time'] = Time::pluck('name','id');
            // dd($model);
            return view('formusagetime', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($request->usage_id);
            if($model->times()->exists()){
            // if(count($model->times)){
				$model = DB::table('time_usage')->where('usage_id',$request->usage_id)->delete();
            }
			for($i=0;$i<$request->count;$i++){
				$time = 'time'.($i+1);
				$time = $request->$time;
				$model = DB::table('time_usage')->insert([
					'usage_id' => $request->usage_id,
					'time_id' => $time
				]);
			}
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($request->usage_id);
            if($model->times()->exists()){
                $model = DB::table('time_usage')->where('usage_id',$request->usage_id)->delete();
                return response()->json($model);
            }
        }
        else{
            abort(404);
        }
    }

    public function datatable()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::get();
            return DataTables::of($model)
            	->addColumn('time', function($model){
            		$i = 0;
                    if($model->times()->exists()){
		            // if(count($model->times)){
	            		foreach($model->times as $a){
		            		$b[$i] = $a->name;
		            		$i++;
	            		}
	            		return $b;
	            	}
	            	return '';
            	})
                ->addColumn('action', function($model){
                    return view('layouts.action',[
                        'model' => $model,
                        'title' => 'Waktu Penggunaan Alat',
                        'edit' => route('timeusage.edit', $model->id),
                        'delete' => route('timeusage.delete', $model->id)
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        else{
            abort(404);
        }
    }
}
