<?php

namespace App\Http\Controllers;

use App\Price;
use App\Tool;
use App\Order;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        if(Auth::User()==NULL){
            // $no = Tool::orderBy('id', 'desc')->value('id');
            $tool = Tool::get();
            $price = Price::get();
            return view('prices.index', ['tool' => $tool, 'price' => $price]);
            // return view('prices.index');
        }
        else if(Auth::User()->value('role')==0){
            // $no = Tool::orderBy('id', 'desc')->value('id');
            $tool = Tool::get();
            $price = Price::get();
            return view('prices.client', ['tool' => $tool, 'price' => $price]);
        }
        else if(Auth::User()->value('role')==1){
            return view('prices.admin');
        }
        else {
            return redirect()->route('welcome');
        }
    }

    public function create()
    {
        $model = new Price();
        return view('prices.form', ['model' => $model]);
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
        return view('prices.form', ['model' => $model]);
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
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->editColumn('price1', function($model){
                $price = 'Rp ';
                $price .= number_format($model->price1, 0, ',', '.');
                return $price;
            })
            ->editColumn('price2', function($model){
                $price = 'Rp ';
                $price .= number_format($model->price2, 0, ',', '.');
                return $price;
            })
            ->editColumn('price3', function($model){
                $price = 'Rp ';
                $price .= number_format($model->price3, 0, ',', '.');
                return $price;
            })
            ->editColumn('discount', function($model){
                $discount = $model->discount.'%';
                return $discount;
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
            ->rawColumns(['action','show'])
            ->make(true);
    }
}
