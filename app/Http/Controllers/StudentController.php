<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use App\Profile;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function delete(Request $request, $id)
    {
        $model = Profile::findOrFail($id)->update([
            'email_lecturer' => NULL,
        ]);
        return response()->json($model);
    }

    public function datatable()
    {
        $email = Auth()->User();
        $mahasiswa = Profile::where('email_lecturer', $email['email'])->get();
        return DataTables::of($mahasiswa)
            ->editColumn('faculty', function($model){
                $faculty = $model->faculty;
                return $faculty;
            })
            ->addColumn('name', function($model){
                return $model->user->name;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>  
<a href="'.route('student.delete',$model->id).'" class="btn btn-danger btn-sm delete" name="'.$model->user->name.'">Remove</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }

    public function booking()
    {
        return view('students.booking');
    }

    public function dataBooking()
    {
        $model = Booking::whereHas('orders', function ($order){
            return $order->whereHas('users', function ($user){
                return $user->whereHas('profiles', function ($profile){
                    return $profile->where('email_lecturer', '=', Auth()->User()->email);
                });
            });
        })->where('status',2)->get();
        return DataTables::of($model)
            ->editColumn('date1', function($model){
                $date = date('d M Y', strtotime($model->date1));
                $time = $model->times1->name;
                return $date.' '.$time;
            })
            ->editColumn('date2', function($model){
                $date = date('d M Y', strtotime($model->date2));
                $time = $model->times2->name;
                return $date.' '.$time;
            })
            ->editColumn('date3', function($model){
                $date = date('d M Y', strtotime($model->date3));
                $time = $model->times3->name;
                return $date.' '.$time;
            })
            ->addColumn('user', function($model){
                return $model->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->orders->tools->name;
            })
            ->addColumn('attend', function($model){
                if ($model->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('plan', function($model){
                return $model->orders->plans->name;
            })
            ->addColumn('purpose', function($model){
                return $model->orders->purpose;
            })
            ->addColumn('sample', function($model){
                return $model->orders->sample;
            })
            ->addColumn('unique', function($model){
                return $model->orders->unique;
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('verify.updateConfirm', $model->id).'" class="btn btn-primary btn-sm confirm" name="'.$model->no_form.'">Confirm</a>
<a href="'.route('verify.showReject', $model->id).'" class="btn btn-danger btn-sm modal-show" name="'.$model->no_form.'">Reject</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times1_id')
            ->removeColumn('times2_id')
            ->removeColumn('times3_id')
            ->removeColumn('users_id')
            ->removeColumn('token')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }
}
