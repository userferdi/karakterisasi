<?php

namespace App\Http\Controllers;

use App\Usage;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public function create()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Usage();
            return view('usage', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::create($request->all());
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
            return view('usage', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Usage::findOrFail($id)->update($request->all());
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
            return response()->json($model);
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
                ->addColumn('action', function($model){
                    return view('layouts.action',[
                        'model' => $model,
                        'title' => 'Status Alat',
                        'edit' => route('usage.edit', $model->id),
                        'delete' => route('usage.delete', $model->id)
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
