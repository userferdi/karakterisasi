<?php

namespace App\Http\Controllers;

use App\Time;
use DataTables;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index()
    {
    	return view('time.client');
    }

    public function admin()
    {
        return view('time.admin');
    }

    public function create()
    {
        $model = new Time();
        return view('form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Time::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Time::findOrFail($id);
        return view('form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Time::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Time::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
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
}
