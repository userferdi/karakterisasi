<?php

namespace App\Http\Controllers;

use App\Service;
use App\Tool;
use App\Order;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        if(Auth::User()==NULL){
            return view('services.index');
        }
        else if(Auth::User()->value('role')==0){
            $no = Tool::orderBy('id', 'desc')->value('id');
            $tool = Tool::get();
            $service = Service::get();
            return view('services.client', ['tool' => $tool, 'service' => $service]);
        }
        else if(Auth::User()->value('role')==1){
            return view('services.admin');
        }
        else {
            return redirect()->route('welcome');
        }
    }

    public function create()
    {
        $model = new Service();
        return view('services.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Service::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Service::findOrFail($id);
        return view('services.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Service::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Service::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Service::get();
        return DataTables::of($model)
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->editColumn('price', function($model){
                $price = 'Rp ';
                $price .= number_format($model->price, 0, ',', '.');
                return $price;
            })
            ->editColumn('discount', function($model){
                $discount = $model->discount.'%';
                return $discount;
            })
            ->addColumn('action', function($model){
                return view('layouts.action',[
                    'model' => $model,
                    'title' => 'Service',
                    'edit' => route('price.edit', $model->id),
                    'delete' => route('price.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action','show'])
            ->make(true);
    }
}
