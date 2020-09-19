<?php

namespace App\Http\Controllers;

use App\Lab;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                return view('labs.admin');
            }
            else if(Auth()->User()->hasRole($client)){
                return view('labs.client');
            }
        }
        else if(Auth()->User()==NULL){
            return view('labs.index');
        }
        else{
            abort(404);
        }
    }

    public function show($id)
    {
        $model = Lab::find($id);
        return view('labs.show', ['model'=>$model]);
    }

    public function create()
    {
        $model = new Lab();
        return view('labs.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'head' => 'required',
            'descrip' => 'required'
        ]);
        $model = Lab::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Lab::findOrFail($id);
        return view('labs.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Lab::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Lab::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Lab::get();
        return DataTables::of($model)
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('lab.show', $model->id).'" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                return view('layouts.action',[
                    'model' => $model,
                    'title' => 'Laboratorium',
                    'edit' => route('lab.edit', $model->id),
                    'delete' => route('lab.delete', $model->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'show'])
            ->make(true);
    }
}
