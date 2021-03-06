<?php

namespace App\Http\Controllers;

use App\Active;
use App\Time;
use App\Lab;
use App\Status;
use App\Usage;
use App\Tool;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ToolController extends Controller
{
    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole('Admin')){
                return view('tools.admin');
            }
            else if(Auth()->User()->hasRole($client)){
                return view('tools.client');
            }
        }
        else if(Auth()->User()==NULL){
            return view('tools.index');
        }
        else{
            abort(404);
        }
    }

    public function show($id)
    {
        $model = Tool::find($id);
        if(Auth()->User()!=NULL){
            return view('tools.show', ['model'=>$model]);
        }
        else if(Auth()->User()==NULL){
            return view('tools.show_index', ['model'=>$model]);
        }
        else{
            abort(404);
        }
    }

    public function create()
    {
        $model = new Tool();
        $model['actives'] = Active::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['labs'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['usages'] = Usage::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:tools'],
            'code' => ['required', 'string', 'unique:tools'],
            'descrip' => ['required', 'string'],
            'sample' => ['required', 'string']
        ]);
        $model = new Tool;
        $model = $request->all();
        $model['image'] = null;
        if($request->file('image')!=null){
            $directory = '/upload/tools/'.$request->code.'/';
            $filename = $request->name.'.'.$request->image->getClientOriginalExtension();
            $model['image'] = $directory.$filename;
            $request->image->move(public_path($directory), $filename);
        }
        $save = Tool::create($model);
        return response()->json($save);
    }

    public function edit($id)
    {
        $model = Tool::find($id);
        $model['actives'] = Active::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['labs'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['usages'] = Usage::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = Tool::findOrFail($id);
        if($request->name!=$model->name){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255', 'unique:tools'],
            ]);
        }
        if($request->code!=$model->code){
            $this->validate($request, [
                'code' => ['required', 'string', 'unique:tools'],
            ]);
        }
        $this->validate($request, [
            'descrip' => ['required', 'string'],
            'sample' => ['required', 'string'],
        ]);

        if ($request->file('image')!=null){
            if ($model->image !== NULL){
                unlink(public_path($model->image));
            }
        }
        $model = $request->all();
        $model['image'] = null;
        if($request->file('image')!=null){
            $directory = '/upload/'.$request->code.'/';
            $filename = $request->name.'.'.$request->image->getClientOriginalExtension();
            $model['image'] = $directory.$filename;
            $request->image->move(public_path($directory), $filename);
        }
        $model = Tool::findOrFail($id)->update($model);
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Tool::findOrFail($id);
        if ($model->image !== NULL){
            File::delete($model->image);
            unlink(public_path($model->image));
        }
        $model = Tool::findOrFail($id)->delete();
        return response()->json($model);
    }

    public function datatable()
    {
        $model = Tool::get();
        return DataTables::of($model)
        	->editColumn('actives_id', function($model){
        		return $model->actives->name;
        	})
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('tool.show',$model->id).'" class="btn btn-danger btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

    public function datatableLab($id)
    {
        $model = Tool::where('labs_id',$id);
        return DataTables::of($model)
            ->editColumn('actives_id', function($model){
                return $model->actives->name;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('tool.show',$model->id).'" class="btn btn-danger btn-sm">show</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

    public function datatableClient()
    {
        $model = Tool::get();
        return DataTables::of($model)
            ->editColumn('actives_id', function($model){
                return $model->actives->name;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('tool.show',$model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

    public function datatableSchedule()
    {
        $model = Tool::get();
        return DataTables::of($model)
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('schedule.show',$model->id).'" class="btn btn-danger btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }

    public function datatableAdmin()
    {
        $model = Tool::get();
        return DataTables::of($model)
            ->editColumn('actives_id', function($model){
                return $model->actives->name;
            })
            ->addColumn('head', function($model){
                return $model->labs->head;
            })
            ->editColumn('labs_id', function($model){
                return $model->labs->name;
            })
            ->editColumn('usages_id', function($model){
                return $model->usages->name;
            })
            ->addColumn('image', function($model){
                if ($model->image == NULL){
                    return 'No Image';
                }
                $url = asset($model->image);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('tool.show',$model->id).'" class="btn btn-primary btn-sm">Detail</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button =
'<div class="btn-group" role="group">
    <button type="button" href="'.route('tool.show', $model->id).'" class="btn btn-primary btn-sm details-control">Detail</button>
    <button type="button" href="'.route('tool.edit', $model->id).'" class="btn btn-primary btn-sm modal-show edit" name="Edit '.$model->name.'">Edit</button>
    <button type="button" href="'.route('tool.delete', $model->id).'" class="btn btn-danger btn-sm delete" name="'.$model->name.'">Delete</button>
</div>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }
}
