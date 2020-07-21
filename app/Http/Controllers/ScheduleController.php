<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Order;
use Illuminate\Http\Request;
use Redirect, Response;

class ScheduleController extends Controller
{
	public function index()
	{
    	// dd($Event);
    	return view('schedule.client');
	}

	public function show($id)
	{
		// $model = Order::get();
        $model = Tool::findOrFail($id);
		return view('schedule.show', ['model' => $model]);
	}

	public function create(Request $request)
	{
		$insertArr = [ 'title' => $request->title,'start' => $request->start,'end' => $request->end];
		// $event = Event::insert($insertArr);
		return Response::json($event);
	}

	public function update(Request $request)
	{
		$where = array('id' => $request->id);
		$updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
		// $event  = Event::where($where)->update($updateArr);
		return Response::json($event);
	}

	public function delete(Request $request)
	{
		// $event = Event::where('id',$request->id)->delete();
		return Response::json($event);
	}
	public function dataschedule()
    {
		$event = Order::get();
    	// $Event = json_encode($allEvent);
    	return json_encode($event);

//         $model = Lab::get();
//         return DataTables::of($model)
//             ->addColumn('show', function($model){
//                 $button = 
// '<a href="" class="btn btn-primary btn-sm">show</a>';
//                 return $button;
//             })
//             ->addColumn('action', function($model){
//                 return view('layout.action',[
//                     'model' => $model,
//                     'title' => 'Laboratorium',
//                     'edit' => route('lab.edit', $model->id),
//                     'delete' => route('lab.delete', $model->id)
//                 ]);
//             })
//             ->addIndexColumn()
//             ->rawColumns(['action', 'show'])
//             ->make(true);
    }
}
