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
    public function create()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Usage();
            $model['usage'] = Usage::pluck('name','id');
            $time = Time::get();
            return view('timeusageCreate', ['model' => $model, 'time' => $time]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255', 'unique:usages'],
            ]);
            $model = Usage::create([
                'name' => $request->name
            ]);
            $model->times()->attach($request->time);
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
            $model['usage'] = Usage::pluck('name','id');
            $time = Time::get();
            $model['selected'] = $model->times()->allRelatedIds()->toArray();
            return view('timeusageEdit', ['model' => $model, 'time' => $time]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::find($id);
            $model->times()->sync($request->time);
            $model->update([
                'name' => $request->name
            ]);
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($id)->delete();
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
