<?php

namespace App\Http\Controllers;

use App\Active;
use App\Time;
use App\Lab;
use App\Period;
use App\Status;
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
        return view('tools.show', ['model'=>$model]);
    }

    public function create()
    {
        $model = new Tool();
        $model['status'] = Active::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['period'] = Time::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $model = new Tool;
        $model = $request->all();
        $model['image'] = null;
        if($request->file('image')!=null){
            $directory = '/upload/'.$request->code.'/';
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
        $model['status'] = Active::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['lab'] = Lab::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        $model['period'] = Time::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('tools.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'descrip' => ['required', 'string'],
            'sample' => ['required', 'string'],
        ]);

        $model = Tool::findOrFail($id);
        if ($request->file('image')!=null){
            if ($model->image !== NULL){
                unlink(public_path($model->image));
                File::delete($model->image);
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
'<a href="'.route('tool.show',$model->id).'" class="btn btn-primary btn-sm">show</a>';
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
'<a href="'.route('schedule.show',$model->id).'" class="btn btn-primary btn-sm">show</a>';
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
         //    ->addColumn('lab', function($model){
         //        return $model->labs->name;
         //    })
         //    ->addColumn('head', function($model){
         //        return $model->labs->head;
         //    })
         //    ->addColumn('usage', function($model){
         //        return $model->usages->name;
         //    })
            // ->addColumn('active', function($model){
            //  return $model->actives->name;
            // })
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
