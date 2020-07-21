<?php

namespace App\Http\Controllers;

use App\Price;
use App\Service;
use DataTables;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
    	return view('price.client');
    }

    public function admin()
    {
        return view('price.admin');
    }

    public function create()
    {
        $model = new Price();
        return view('form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Price::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Price::findOrFail($id);
        return view('form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Price::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Price::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Price::get();
        return DataTables::of($model)
            ->addColumn('service', function($model){
                return $model->services->name;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                return view('layout.action',[
                    'model' => $model,
                    'title' => 'Service',
                    'edit' => route('price.edit', $model->id),
                    'delete' => route('price.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'show'])
            ->make(true);
    }
}
