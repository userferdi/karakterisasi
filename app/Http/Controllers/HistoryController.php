<?php

namespace App\Http\Controllers;

use App\Tool;
use App\Approve;
use App\Price;
use App\User;
use App\Booking;

use Auth;
use DataTables;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function liatsemua()
    {
        return view('activities.status.liat');
    }
    public function dtliatsemua()
    {
        $model = Booking::get();
        return DataTables::of($model)
            ->addColumn('user', function($model){
                return $model->orders->users->name;
            })
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }

    public function activities()
    {
        $model=Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad')){
	        return view('activities.history');
	    }
	    else{
	    	abort(404);
	    }
    }

    public function data()
    {
        $model=Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad')){
            $model = Approve::where(function($model){
                $model->whereHas('orders', function ($order){
                        return $order->where('users_id', '=', Auth()->User()->id);
                    })->where('status',4)
                    ->orWhereHas('orders', function ($order){
                        return $order->whereHas('users', function ($user){
                            return $user->whereHas('profiles', function ($profile){
                                return $profile->where('email_lecturer', '=', Auth()->User()->email);
                            });
                        });
                    })->where('status',4);
            })->get();
        }
        else if($model->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')){
            $model = Approve::where(function($model){
                $model->whereHas('orders', function ($order){
                    return $order->where('users_id', '=', Auth()->User()->id);
                });
            })->where('status',4)->get();
        }
        else{
            abort(404);
        }
        return DataTables::of($model)
            ->addColumn('user', function($model){
                return $model->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->orders->tools->name;
            })
            ->addColumn('total', function($model){
                $model['total'] = 0;
                foreach($model->payments->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->times->name;
                return $date.' '.$time;
            })
            ->addColumn('status', function($model){
                return 'Completed';
            })
            ->addColumn('plan', function($model){
                return $model->orders->plans->name;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('history.show', $model->id).'" class="btn btn-primary btn-sm" name="'.$model->no_regis.'">Lihat</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }

    public function showHistory($id)
    {
        $model = Approve::find($id);
        $price = Price::get();
        if($model->orders->plans_id == 3){
            $email_lecturer = $model->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->date));
        $model['datetime'] = $date.' '.$model->times->name;
        return view('history.show', ['model' => $model, 'price'=>$price]);
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
'<a href="'.route('history.showTool',$model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
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
        })->where('status',4)->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->times->name;
                return $date.' '.$time;
            })
            ->addColumn('user', function($model){
                return $model->orders->users->name;
            })
            ->addColumn('total', function($model){
                $model['total'] = 0;
                foreach($model->payments->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('status', function($model){
            	if($model->status==1){
	                return 'Menunggu Jadwal Penggunaan Alat';
            	}
            	else if($model->status==2){
	                return 'Menunggu Pembayaran';
            	}
            	else if($model->status==3){
	                return 'Menunggu Verifikasi Pembayaran';
            	}
                else if($model->status==4){
                    return 'Completed';
                }
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('history.show', $model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }

    public function user()
    {
        return view('history.user');
    }

    public function dataUser()
    {
        $model = User::get()->reject(function ($user) {
            return $user->hasRole('Admin');
        });
        return DataTables::of($model)
            ->addColumn('role', function($model){
                return $model->roles[0]->name;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('history.showUser',$model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }

    public function showUser($id)
    {
        $model = User::find($id);
        return view('history.showuser', ['model'=>$model]);
    }

    public function dataShowUser($id)
    {
    	$model = Approve::whereHas('orders', function ($order) use ($id){
            return $order->where('users_id', $id);
        })->where('status',4)->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->times->name;
                return $date.' '.$time;
            })
            ->addColumn('tool', function($model){
                return $model->orders->tools->name;
            })
            ->addColumn('total', function($model){
                $model['total'] = 0;
                foreach($model->payments->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('status', function($model){
                if($model->status==1){
                    return 'Menunggu Jadwal Penggunaan Alat';
                }
                else if($model->status==2){
                    return 'Menunggu Pembayaran';
                }
                else if($model->status==3){
                    return 'Menunggu Verifikasi Pembayaran';
                }
                else if($model->status==4){
                    return 'Completed';
                }
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('history.show', $model->id).'" class="btn btn-primary btn-sm" name="'.$model->no_regis.'">show</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }

}
