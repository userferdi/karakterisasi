<?php

namespace App\Http\Controllers;

use App\Usage;
use DataTables;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $model = new Usage();
        return view('usage', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Usage::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Usage::findOrFail($id);
        return view('usage', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Usage::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Usage::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
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
}
