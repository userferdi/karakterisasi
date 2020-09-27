<?php

namespace App\Http\Controllers;

use App\Price;
use App\Tool;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        $tool = Tool::get();
        $price = Price::get();
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                return view('prices.admin');
            }
            else if(Auth()->User()->hasRole($client)){
                return view('prices.client', ['tool' => $tool, 'price' => $price]);
            }
        }
        else if(Auth()->User()==NULL){
            return view('prices.index', ['tool' => $tool, 'price' => $price]);
        }
        else{
            abort(404);
        }
    }

    public function create()
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = new Price();
            $model['tool'] = Tool::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
            return view('prices.form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Price::create($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Price::findOrFail($id);
            return view('prices.form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Price::findOrFail($id)->update($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Price::findOrFail($id)->delete();
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function datatable()
    {
        $model = Price::get();
        return DataTables::of($model)
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->editColumn('price1', function($model){
                return 'Rp '.number_format($model->price1, 0, ',', '.');
            })
            ->editColumn('price2', function($model){
                return 'Rp '.number_format($model->price2, 0, ',', '.');
            })
            ->editColumn('price3', function($model){
                return 'Rp '.number_format($model->price3, 0, ',', '.');
            })
            ->editColumn('discount', function($model){
                return $model->discount.'%';
            })
            ->addColumn('action', function($model){
                return view('layouts.action',[
                    'model' => $model,
                    'title' => 'Price',
                    'edit' => route('price.edit', $model->id),
                    'delete' => route('price.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->removeColumn(['id','created_at','updated_at'])
            ->rawColumns(['action','show'])
            ->make(true);
    }
}
