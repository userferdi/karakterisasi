<?php

namespace App\Http\Controllers;

use App\Period;
use DataTables;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
    }

    public function admin()
    {
    }

    public function create()
    {
        $model = new Period();
        return view('period', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = Period::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Period::findOrFail($id);
        return view('period', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Period::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Period::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Period::get();
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
                    'edit' => route('period.edit', $model->id),
                    'delete' => route('period.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'show'])
            ->make(true);
    }
}
