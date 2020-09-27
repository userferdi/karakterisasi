<?php

namespace App\Http\Controllers;

use App\Time;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function create()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Time();
            return view('form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Time::create($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Time::findOrFail($id);
            return view('form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Time::findOrFail($id)->update($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Time::findOrFail($id)->delete();
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function datatable()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Time::get();
            return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts.action',[
                        'model' => $model,
                        'title' => 'Waktu Penggunaan Alat',
                        'edit' => route('time.edit', $model->id),
                        'delete' => route('time.delete', $model->id)
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
