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
        if(Auth()->User()->hasRole('Admin')){
            $model = new Lab();
            return view('labs.form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function store(Request $request)
    {
        if(Auth()->User()->hasRole('Admin')){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255', 'unique:labs'],
                'code' => ['required', 'string', 'min:3', 'max:7', 'unique:labs'],
                'head' => ['required', 'string', 'max:255'],
                'descrip' => ['required', 'string']
            ]);
            $model = Lab::create($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function edit($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Lab::findOrFail($id);
            return view('labs.form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Lab::findOrFail($id);
            if($request->name!=$model->name){
                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255', 'unique:labs'],
                ]);
            }
            if($request->code!=$model->code){
                $this->validate($request, [
                    'code' => ['required', 'string', 'min:3', 'max:7', 'unique:labs'],
                ]);
            }
            $this->validate($request, [
                'head' => ['required', 'string', 'max:255'],
                'descrip' => ['required', 'string']
            ]);
            $model = Lab::findOrFail($id)->update($request->all());
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function delete($id)
    {
        if(Auth()->User()->hasRole('Admin')){
            $model = Lab::findOrFail($id)->delete();
            return response()->json($model);
        }
        else{
            abort(404);
        }
    }

    public function datatable()
    {
        $model = Lab::get();
        return DataTables::of($model)
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('lab.show', $model->id).'" class="btn btn-danger btn-sm">show</a>';
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
            ->removeColumn(['id','created_at','updated_at'])
            ->rawColumns(['action', 'show'])
            ->make(true);
    }
}
