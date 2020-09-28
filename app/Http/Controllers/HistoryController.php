<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Approve;

use DataTables;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function activities()
    {
        return view('history.activities');
    }

    public function tool()
    {
        return view('history.tool');
    }

    public function dataTool()
    {
        $model = Tool::get();
        return DataTables::of($model)
        	->editColumn('actives_id', function($model){
        		return $model->actives->name;
        	})
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('history.showTool',$model->id).'" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

    public function showTool($id)
    {
        $model = Tool::find($id);
        return view('history.showtool', ['model'=>$model]);
    }

    public function dataShowTool($id)
    {
    	$model = Approve::whereHas('orders', function ($order) use ($id){
            return $order->where('tools_id', $id);
        })->get();
        return DataTables::of($model)
            ->addIndexColumn()
            ->rawColumns(['action','booking','schedule','image','show'])
            ->make(true);
    }

    public function user()
    {
        return view('history.activities');
    }

}
