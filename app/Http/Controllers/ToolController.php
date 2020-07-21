<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Status;
use App\Lab;
use App\Time;
use DataTables;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
    	return view('tool.client');
    }

    public function admin()
    {
        return view('tool.admin');
    }

    public function create()
    {
        $model = new Tool();
        $model['status'] = Status::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['time'] = Time::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tool.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Tool::create($request->all());
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Tool::findOrFail($id);
        $model['status'] = Status::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['time'] = Time::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tool.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Tool::findOrFail($id)->update($request->all());
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Tool::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Tool::get();
        return DataTables::of($model)
        	->addColumn('status', function($model){
        		return $model->statuses->name;
        	})
            ->addColumn('show', function($model){
                $button = 
'<a href="" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addColumn('schedule', function($model){
                $button = 
'<a href="'.route('schedule.show',$model->id).'" class="btn btn-primary btn-sm">Lihat Jadwal</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('tool.show', $model->id).'" class="details-control" name="Details Product: '.$model->name.'"><i class="nav-icon fas fa-eye text-primary"></i></a> | 
<a href="'.route('tool.edit', $model->id).'" class="modal-show edit" name="Edit '.$model->name.'"><i class="nav-icon fas fa-pencil-alt text-primary"></i></a> | 
<a href="'.route('tool.delete', $model->id).'" class="delete" name="'.$model->name.'"><i class="nav-icon fas fa-trash-alt text-danger"></i></a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','show','schedule'])
            ->make(true);
    }
}
