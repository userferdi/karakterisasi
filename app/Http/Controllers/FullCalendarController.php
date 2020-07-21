<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Calendar;
use App\Event;
use Redirect, Response;

class FullCalendarController extends Controller
{
	public function index()
	{
		$event=Event::where('approved','1')->get();
    	// dd($Event);
    	return view('fullcalendar')->with('event',$event);
		// $events = [];
  //       $data = Event::all();
  //       if($data->count()) {
  //           foreach ($data as $key => $value) {
  //               $events[] = Calendar::event(
  //                   $value->title,
  //                   true,
  //                   new \DateTime($value->start_date),
  //                   new \DateTime($value->end_date.' +1 day'),
  //                   null,
  //                   // Add color and link on event
	 //                [
	 //                    'color' => '#f05050',
	 //                    'url' => 'pass here url and any route',
	 //                ]
  //               );
  //           }
  //       }
  //       $calendar = Calendar::addEvents($events);
  //       return view('fullcalender', compact('calendar'));

		// if(request()->ajax()){
		// 	$start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
		// 	$end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
		// 	$data = Event::whereDate('start', '>=', $start)
		// 		->whereDate('end',   '<=', $end)
		// 		->get(['id','title','start', 'end']);
		// 	return Response::json($data);
		// }

		// return view('fullcalender');
	}

	public function create(Request $request){
		$insertArr = [ 'title' => $request->title,'start' => $request->start,'end' => $request->end];
		$event = Event::insert($insertArr);
		return Response::json($event);
	}

	public function update(Request $request){
		$where = array('id' => $request->id);
		$updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
		$event  = Event::where($where)->update($updateArr);
		return Response::json($event);
	}

	public function delete(Request $request){
		$event = Event::where('id',$request->id)->delete();
		return Response::json($event);
	}
	public function datacalendar()
    {
		$event = Event::get();
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
