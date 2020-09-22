<?php

namespace App\Http\Controllers;

use App\Active;

use DataTables;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function index()
    {
    }

    public function admin()
    {
    }

    public function create()
    {
        $model = new Active();
        return view('active', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = Active::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Active::findOrFail($id);
        return view('active', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Active::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Active::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Active::get();
        return DataTables::of($model)
            ->addColumn('show', function($model){
                $button = 
'<a href="" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                return view('layouts.action',[
                    'model' => $model,
                    'title' => 'Waktu Penggunaan',
                    'edit' => route('active.edit', $model->id),
                    'delete' => route('active.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['show', 'action'])
            ->make(true);
    }
}
