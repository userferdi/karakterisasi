<?php

namespace App\Http\Controllers;

use App\Service;
use DataTables;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
    	return view('service.client');
    }

    public function admin()
    {
        return view('service.admin');
    }

    public function create()
    {
        $model = new Service();
        return view('form', ['model' => $model]);
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
        return view('form', ['model' => $model]);
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
            ->addColumn('show', function($model){
                $button = 
'<a href="" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                return view('layout.action',[
                    'model' => $model,
                    'title' => 'Service',
                    'edit' => route('service.edit', $model->id),
                    'delete' => route('service.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action','show'])
            ->make(true);
    }
}
