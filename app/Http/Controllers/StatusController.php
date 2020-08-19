<?php

namespace App\Http\Controllers;

use App\Status;
use DataTables;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
    }

    public function admin()
    {
    }

    public function create()
    {
        $model = new Status();
        return view('status', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Status::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Status::findOrFail($id);
        return view('status', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Status::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Status::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Status::get();
        return DataTables::of($model)
            ->addColumn('action', function($model){
                return view('layouts.action',[
                    'model' => $model,
                    'title' => 'Status Alat',
                    'edit' => route('status.edit', $model->id),
                    'delete' => route('status.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
