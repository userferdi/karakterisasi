<?php

namespace App\Http\Controllers;

use App\Active;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function create()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Active();
            return view('active', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255', 'unique:actives'],
            ]);
            $model = Active::create($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Active::findOrFail($id);
            return view('active', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255', 'unique:actives'],
            ]);
            $model = Active::findOrFail($id)->update($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Active::findOrFail($id)->delete();
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function datatable()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Active::get();
            return DataTables::of($model)
                ->addColumn('action', function($model){
                    return view('layouts.action',[
                        'model' => $model,
                        'title' => 'Waktu Penggunaan',
                        'edit' => route('active.edit', $model->id),
                        'delete' => route('active.delete', $model->id)
                    ]);
                })
                ->addIndexColumn()
                ->removeColumn(['id','created_at','updated_at'])
                ->rawColumns(['show', 'action'])
                ->make(true);
        }
        else{
            abort(404);
        }
    }
}
