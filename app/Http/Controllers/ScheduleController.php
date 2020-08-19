<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Order;
use App\Approve;
// use App\Status;
use App\Lab;
use App\Time;
use App\User;
use DataTables;
use Illuminate\Http\Request;
// use Redirect, Response;
use Auth;

class ScheduleController extends Controller
{
	public function index()
	{
    	return view('schedules.client');
	}

    public function show(Request $request, $id)
    {
        // dd($request->);
        // dd($id);
        // dd($event);
        // if($request->route('id') != null){
            // $cek = $request->route('id');
            // dd($request->route('id'));
            $model = Tool::findOrFail($id);
            $model['tools_id'] = $id;
            // dd($model->tools_id);
            return view('schedules.show', ['model' => $model]);
        // }
        // }
    }

    public function admin()
    {
        return view('schedules.admin');
    }

    public function status()
    {
        // $model = Order::select('title')->get();
        // dd($model);
        return view('schedules.status');
    }

    public function astatus()
    {
        // $model = Order::where('tools_id', '1')->get();
        // $event = json_encode($model);
        // dd($event);

        // dd($model);
        return view('schedules.admin');
    }

	public function registration()
	{
		// $model = Order::get();
        // $model = Tool::findOrFail($id);
        // dd($model);
		return view('schedules.registration');
	}

	public function tool()
	{
		// $model = Order::get();
        // $model = Tool::findOrFail($id);
        // dd($model);
		return view('schedules.booking');
	}

	public function create($id)
	{
        $model = new Order();
		// $event=Event::where('approved','1')->get();
        $model['tool'] = Tool::where('id',$id)->pluck('name', 'id');
        $model['time'] = Time::all()->pluck('name', 'id');
        // $model['user'] = User::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        // dd($model);
        // $insertArr = [ 'title' => $request->title,'start' => $request->start,'end' => $request->end];
		// $event = Event::insert($insertArr);
		return view('schedules.create', ['model' => $model]);
	}

    public function store(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'sample' => 'required',
            'unique' => 'required'
        ]);
        $model = new Order;
        // $model = $request->all();
        $nama = Auth::User()->name;
        $code_tool = Tool::where('id',$request['tools_id'])->value('code');
        $labs_id = Tool::where('id',$request['tools_id'])->value('labs_id');
        $code_lab = Lab::where('id',$labs_id)->value('code');
        // dd($request, $labs_id, $code_lab);

        $no = Order::orderBy('id', 'desc')->value('id');
        if($no == NULL){
            $no = 1;
            $model['no_regis'] = $no.'/'.$code_lab.'/'.$code_tool;
            $model['title'] = $no.'/'.$code_lab.'/'.$code_tool.' : '.$nama;
        }
        else{
            $no+=1;
            $model['no_regis'] = $no.'/'.$code_lab.'/'.$code_tool;
            $model['title'] = $no.'/'.$code_lab.'/'.$code_tool.' : '.$nama;
        }


        $model['users_id'] = Auth::User()->id;
        $model['tools_id'] = $request['tools_id'];
    	$date = $request['date'];
    	$time = Time::where('id',$request['times_id'])->value('time_start');
        // $model['time_start'] = $time;
    	$model['start'] = date('Y-m-d H:i:s', strtotime("$date $time"));
    	$time = Time::where('id',$request['times_id'])->value('time_end');
        // $model['time_end'] = $time;
    	$model['end'] = date('Y-m-d H:i:s', strtotime("$date $time"));
        $model['date'] = $request['date'];
        $model['times_id'] = $request['times_id'];
        $model['attend'] = $request['attend'];
        $model['purpose'] = $request['purpose'];
        $model['sample'] = $request['sample'];
        $model['unique'] = $request['unique'];
        // dd($model, $request);
        $model->save();
        // dd($model);
    	// dd($model, $baru);
        return redirect()->route('schedule.status');
    }

    public function edit($id)
    {
        $model = Order::findOrFail($id);
        $model['approve'] = Approve::all()->pluck('name', 'id');
        return view('schedules.form_edit', ['model' => $model]);
    }

	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'approves_id' => 'required'
        ]);

        $model = Order::findOrFail($id)->update($request->all());
        return response()->json($model);
	}

	public function delete(Request $request, $id)
	{
        $request['approves_id'] = 4;
        $model = Order::findOrFail($id)->update($request->all());
		return response()->json($model);
	}

	public function dataschedule()
    {
        // $event = Order::get();
        $event = Order::where(['approves_id'=>'2'])->get();
        // $event['title'] = $event['no_regis'];
    	return json_encode($event);
    }

    public function data($id)
    {
        $event = Order::where(['approves_id'=>'2', 'tools_id'=>$id])->get();
        return json_encode($event);
    }

    public function all()
    {
        $id = Auth::User()->id;
        $model = Order::get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                return date('d M Y', strtotime($model->date));
            })
            ->addColumn('time', function($model){
                return $model->times->name;
            })
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->addColumn('user', function($model){
                return $model->users->name;
            })
            ->addColumn('hadir', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('action', function($model){
                if ($model->approves_id == 1){
                    $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-warning btn-sm edit modal-show" name="'.$model->title.'">Booking</a>';
                    return $button;
                }
                if ($model->approves_id == 2){
                    $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-success btn-sm edit modal-show" name="'.$model->title.'">Approved</a>';
                    return $button;
                }
                if ($model->approves_id == 3){
                    $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-danger btn-sm edit modal-show" name="'.$model->title.'">Rejected</a>';
                    return $button;
                }
                if ($model->approves_id == 4){
                    $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-dark btn-sm edit modal-show" name="'.$model->title.'">Cancel</a>';
                    return $button;
                }
            })
            ->addIndexColumn()
            // ->selectRaw('DATE_FORMAT(date, "%d/%l/%Y") as date')
            ->rawColumns(['hadir', 'action'])
            ->make(true);
    }

    public function booking()
    {
        $id = Auth::User()->id;
        $model = Order::where(['approves_id'=>'1', 'users_id'=>$id])->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                return date('d M Y', strtotime($model->date));
            })
            ->addColumn('time', function($model){
                return $model->times->name;
            })
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->addColumn('user', function($model){
                return $model->users->name;
            })
            ->addColumn('hadir', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-warning btn-sm edit modal-show" name="'.$model->title.'">Booking</a>';
                return $button;
            })
            ->addColumn('delete', function($model){
                $button = '<a href="'.route('schedule.delete',$model->id).'" class="btn btn-danger btn-sm delete" name="'.$model->no_regis.'">Cancel</a>';
                return $button;
            })
//             ->addColumn('action', function($model){
//                 $button = 
// '<a href="'.route('tool.show', $model->id).'" class="details-control" name="Details Product: '.$model->name.'"><i class="nav-icon fas fa-eye text-primary"></i></a> | 
// <a href="'.route('tool.edit', $model->id).'" class="modal-show edit" name="Edit '.$model->name.'"><i class="nav-icon fas fa-pencil-alt text-primary"></i></a> | 
// <a href="'.route('tool.delete', $model->id).'" class="delete" name="'.$model->name.'"><i class="nav-icon fas fa-trash-alt text-danger"></i></a>';
//                 return $button;
//             })
            ->addIndexColumn()
            ->rawColumns(['hadir', 'action', 'delete'])
            ->make(true);
    }

    public function approved()
    {
        $id = Auth::User()->id;
        $model = Order::where(['approves_id'=>'2', 'users_id'=>$id])->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                return date('d M Y', strtotime($model->date));
            })
            ->addColumn('time', function($model){
                return $model->times->name;
            })
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->addColumn('user', function($model){
                return $model->users->name;
            })
            ->addColumn('hadir', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-success btn-sm edit modal-show" name="'.$model->title.'">Approved</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['hadir', 'action'])
            ->make(true);
    }

    public function rejected()
    {
        $id = Auth::User()->id;
        $model = Order::where(['approves_id'=>'3', 'users_id'=>$id])->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                return date('d M Y', strtotime($model->date) );
            })
            ->addColumn('time', function($model){
                return $model->times->name;
            })
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->addColumn('user', function($model){
                return $model->users->name;
            })
            ->addColumn('hadir', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-danger btn-sm edit modal-show" name="'.$model->title.'">Rejected</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['hadir', 'action'])
            ->make(true);
    }

    public function cancel()
    {
        $id = Auth::User()->id;
        $model = Order::where(['approves_id'=>'4', 'users_id'=>$id])->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                return date('d M Y', strtotime($model->date) );
            })
            ->addColumn('time', function($model){
                return $model->times->name;
            })
            ->addColumn('tool', function($model){
                return $model->tools->name;
            })
            ->addColumn('user', function($model){
                return $model->users->name;
            })
            ->addColumn('hadir', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('schedule.edit',$model->id).'" class="btn btn-dark btn-sm edit modal-show" name="'.$model->title.'">Cancel</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['hadir', 'action'])
            ->make(true);
    }

}
