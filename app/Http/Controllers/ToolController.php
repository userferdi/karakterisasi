<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Status;
use App\Lab;
use App\Period;
use DataTables;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
    	return view('tools.client');
    }

    public function admin()
    {
        // $model = Tool::with('Uses')->get();
        // dd($model);
        return view('tools.admin');
    }

    public function show($id)
    {
        $model = Tool::find($id);
        return view('tools.show', ['model'=>$model]);
    }

    public function create()
    {
        $model = new Tool();
        $model['status'] = Status::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['period'] = Period::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        // dd($model);
        $this->validate($request, [
            'name' => ['required', 'string'],
            'code' => ['required', 'string', 'min:2', 'max:4'],
            'descrip' => ['required', 'string', 'max:255'],
            'sample' => ['required', 'string', 'max:255'],
        ]);

        $model = new Tool;
        $model = $request->all();
        $model['image'] = null;
        if($request->hasFile('image')){
            $directory = '/upload/'.$request->code.'/';
            $filename = $request->name.'.'.$request->image->getClientOriginalExtension();
            $model['image'] = $directory.$filename;
            $request->image->move(public_path($directory), $filename);
        }
        $baru = Tool::create($model);
        // $baru->save();
        dd($baru);
        $model['name'] = $request->name;
        $model['code'] = $request->code;
        $model['descrip'] = $request->descrip;
        $model['sample'] = $request->sample;
        $model['statuses_id'] = $request->statuses_id;
        $model['labs_id'] = $request->labs_id;
        $model['periods_id'] = $request->periods_id;
        $model->save();
        return response()->json($model);
    }

    public function edit($id)
    {
        $model = Tool::find($id);
        $model['status'] = Status::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['period'] = Period::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = Tool::findOrFail($id);
        if ($request->hasFile('image')){
            if ($model->image !== NULL){
                unlink(public_path($model->image));
            }
        }

        $this->validate($request, [
            'name' => 'required'
        ]);
        $model = Tool::findOrFail($id)->update($request->all());
        dd($request, $model);
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
            ->addColumn('lab', function($model){
                return $model->labs->name;
            })
            ->addColumn('head', function($model){
                return $model->labs->head;
            })
            ->addColumn('period', function($model){
                return $model->periods->name;
            })
        	->addColumn('status', function($model){
        		return $model->statuses->name;
        	})
            ->addColumn('image', function($model){
                if ($model->image == NULL){
                    return 'No Image';
                }
                $url= asset($model->image);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->addColumn('booking', function($model){
                $button = 
'<a href="'.route('schedule.create',$model->id).'" class="btn btn-primary btn-sm">Registrasi</a>';
                return $button;
            })
            ->addColumn('schedule', function($model){
                $button = 
'<a href="'.route('schedule.show',$model->id).'" class="btn btn-primary btn-sm">Lihat Jadwal</a>';
                return $button;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('tool.show',$model->id).'" class="btn btn-primary btn-sm">Detail</a>';
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
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

}
