<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Payment;
use App\Price;
use App\Plan;
use App\Order;

use PDF;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    public function coba()
    {
         $your_string = '2 3 12 34 ';
        $array = str_split($your_string);
        $i=0; $j=0; $k=0; $l=0;
        foreach ($array as $char){
            if($char == ' '){
                $no[$k] = 0;
                for($j=$l;$j<$i;$j++){
                    if(empty($no[$k])){
                        $no[$k] = $array[$j];
                    }
                    else{
                        $no[$k] .= $array[$j];
                    }
                }
                $l=$i+1;
                $k++;
            }
            $i++;
        }

        dd($no,$array);
        $pdf = PDF::loadview('payment.streambill');
        return $pdf->stream();

        return view('payment.streambill');
        $pegawai = Pegawai::all();
    }

    public function index()
    {
        $client = ['Dosen Unpad', 'Dosen Non Unpad', 'Mahasiswa Unpad', 'Mahasiswa Non Unpad', 'User Umum'];
        if(Auth()->User()!=NULL){
            if(Auth()->User()->hasRole($client)){
                return view('payment.index');
            }
        }
        else{
            abort(404);
        }
    }

    public function form($id)
    {
        $model = Approve::find($id);
        if($model->status == 1){
            return view('payment.form', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function formUpload($id)
    {
        $model = Payment::find($id);
        if($model->status==2|$model->status==3|$model->status==4|$model->status==5){
            return view('payment.formupload', ['model' => $model]);
        }
        else{
            abort(404);
        }
    }

    public function updateUpload(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);
        $model = Payment::find($id);
        if ($request->file('image')!=null){
            if ($model->image !== NULL){
                unlink(public_path($model->image));
            }
        }
        $model['image'] = null;
        $date = date("Y/m");
        if($request->file('image')!=null){
            $directory = '/upload/proof/'.$date.'/';
            $filename = $model->id.'-'.$model->approves->orders->tools->labs->code.'-'.$model->approves->orders->tools->code.'-'.$model->approves->orders->users->name.'.'.$request->image->getClientOriginalExtension();
            $model['image'] = $directory.$filename;
            $request->image->move(public_path($directory), $filename);
        }
        $save = $model->update();
        if($save==true){
            $save = Approve::where('id', $model->approves_id)->update([
                'status' => 2
            ]);
            if($model->status==2){
                $save = Payment::find($id)->update([
                    'status' => 4
                ]);
            }
            if($model->status==3){
                $save = Payment::find($id)->update([
                    'status' => 5
                ]);
            }
        }
        return response()->json($save);
    }

    public function bill()
    {
        if(Auth()->User()!=NULL){
            return view('payment.bill');
        }
        else{
            abort(404);
        }
    }

    public function formBill(Request $request, $id)
    {
        $model = Approve::find($id);
        $plan = PLan::get();
        if($model->orders->users->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){
            $model['plan'] = Plan::pluck('name','id');
        }
        else{
            $model['plan'] = $plan->reject(function ($plan){
                if($plan->id==3){
                    return true;
                }
            })->pluck('name','id');
        }
        $model['many'] = $request->many;
        $model['service'] = Price::where('tools_id',$model->orders->tools_id)->pluck('service','id');
        return view('payment.formbill', ['model' => $model]);
    }

    public function showBill($id)
    {
        $model = Payment::find($id);
        $price = Price::get();
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        // dd());
            // $time_start = Time::where('id',$time)->value('time_start');
        $model['datetime'] = $date.' '.$model->approves->times->name;
        // dd($model->created_at->format('Y-m-d'));
        // $model['date'] =  date('Y-m-d',$model->created_at);
        // $model['many'] = $request->many;
        // $model['service'] = Price::where('tool_id',$model->orders->tools_id)->pluck('service','id');
        return view('payment.showbill', ['model' => $model, 'price'=>$price]);
    }

    public function updateBill(Request $request, $id)
    {
        $model = Approve::find($id);
        if($model->status == 1){
            $save = Order::where('id', $model->orders_id)->update([
                'plans_id' => $request->plans_id
            ]);
            $payment = new Payment;
            $no = Payment::orderBy('id', 'desc')->value('id');
            $payment['date_invoice'] = date('Y-m-d');
            if($no == NULL){
                $no = 1;
                $payment['no_invoice'] = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code.$payment->date_invoice;
            }
            else{
                $no+=1;
                $payment['no_invoice'] = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code.$payment->date_invoice;
            }
            if($model->orders->users->hasRole('Dosen Unpad|Mahasiswa Unpad')){
                $price = Price::where('id',$request->service1)->first();
                $price = $price->price1;
                $quantity = $request->quantity1;
                $total = $price*$quantity;
                for($i=1;$i<$request->many;$i++){
                    $quantity = 'quantity'.($i+1);
                    $quantity = $request->$quantity;
                    $service = 'service'.($i+1);
                    $service = $request->$service;
                    $price = Price::where('id',$service)->first();
                    $price = $price->price1;
                    $total = $total+($price*$quantity);
                }
            }
            else if($model->orders->users->hasRole('Dosen Non Unpad|Mahasiswa Non Unpad')){
                $price = Price::where('id',$request->service1)->first();
                $price = $price->price2;
                $quantity = $request->quantity1;
                $total = $price*$quantity;
                for($i=1;$i<$request->many;$i++){
                    $quantity = 'quantity'.($i+1);
                    $quantity = $request->$quantity;
                    $service = 'service'.($i+1);
                    $service = $request->$service;
                    $price = Price::where('id',$service)->first();
                    $price = $price->price2;
                    $total = $total+($price*$quantity);
                }
            }
            else if($model->orders->users->hasRole('User Umum')){
                $price = Price::where('id',$request->service1)->first();
                $price = $price->price3;
                $quantity = $request->quantity1;
                $total = $price*$quantity;
                for($i=1;$i<$request->many;$i++){
                    $quantity = 'quantity'.($i+1);
                    $quantity = $request->$quantity;
                    $service = 'service'.($i+1);
                    $service = $request->$service;
                    $price = Price::where('id',$service)->first();
                    $price = $price->price3;
                    $total = $total+($price*$quantity);
                }
            }

            $payment['quantity'] = $request->quantity1.' ';
            $payment['service'] = $request->service1.' ';
            for($i=1;$i<$request->many;$i++){
                $quantity = 'quantity'.($i+1);
                $service = 'service'.($i+1);
                $payment['quantity'] .= $request->$quantity.' ';
                $payment['service'] .= $request->$service.' ';
            }
            $payment['approves_id'] = $id;
            $payment['total'] = $total;
            if($model->orders->plans_id == 1){
                $payment['status'] = 1;
                $save = Approve::findOrFail($id)->update([
                    'status' => 2
                ]);
            }
            else if($model->orders->plans_id == 2){
                $payment['status'] = 2;
            }
            else{
                $payment['status'] = 3;
            }
            $save = $payment->save();
            return response()->json($save);
        }
        else{
            abort(404);
        }
    }

    public function dataBill()
    {
        $model=Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->where('users_id', '=', Auth()->User()->id);
                        });
                    })->where(function($model){
                            $model->where('status',1)
                                ->orWhere('status',2)
                                ->orWhere('status',4);
                        })
                    ->orWhereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->whereHas('users', function ($user){
                                return $user->whereHas('profiles', function ($profile){
                                    return $profile->where('email_lecturer', '=', Auth()->User()->email);
                                });
                            });
                        });
                    })->where(function($model){
                            $model->where('status',3)
                                ->orWhere('status',5);
                        });
            })->get();
        }
        else if($model->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                    return $query->whereHas('orders', function ($order){
                        return $order->where('users_id', '=', Auth()->User()->id);
                    });
                });
            })->where(function($model){
                $model->where('status',1)
                    ->orWhere('status',2)
                    ->orWhere('status',4);
            })->get();
        }
        else{
            abort(404);
        }
        return DataTables::of($model)
            ->editColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('user', function($model){
                return $model->approves->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->approves->orders->tools->name;
            })
            ->addColumn('date', function($model){
                $date = date('d M Y', strtotime($model->approves->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('plan', function($model){
                $plan = $model->approves->orders->plans->name;
                if($plan=='Tunai'){
                    return $plan;
                }
                else if($model->image!=NULL){
                    $button = 
'<p>'.$plan.'</p><a href="#" class="btn btn-primary btn-sm details-control">Show Image</a>&nbsp;
<a href="'.route('payment.formUpload', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Upload Bukti Transfer">Reupload</a>';
                    return $button;
                }
                else{
                    $button = 
'<p>'.$plan.'</p><a href="'.route('payment.formUpload', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Upload Bukti Transfer">Upload</a>';
                    return $button;
                }
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('payment.showBill', $model->id).'" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('approves_id')
            ->removeColumn('no_receipt')
            ->removeColumn('date_invoice')
            ->removeColumn('date_receipt')
            ->removeColumn('status')
            ->removeColumn('quantity')
            ->removeColumn('service')
            ->removeColumn('created_at')
            ->removeColumn('updated_at')
            ->addIndexColumn()
            ->rawColumns(['plan','show'])
            ->make(true);
    }

    public function datatableBill()
    {
        $model = Approve::where('status',1)->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->times->name;
                return $date.' '.$time;
            })
            ->addColumn('user', function($model){
                return $model->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->orders->tools->name;
            })
            ->addColumn('lecturer', function($model){
                return $model->orders->users->profiles->email_lecturer;
            })
            ->addColumn('plan', function($model){
                return $model->orders->plans->name;
            })
            ->addColumn('attend', function($model){
                if ($model->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
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
                if ($model->payments()->exists()){
                // if (count($model->payments)){
                    $button = 
'<a href="'.route('payment.form', $model->id).'" class="btn btn-primary btn-sm modal-show" name="'.$model->no_regis.'">Edit</a>';
                    return $button;
                }
                else{
                    $button = 
'<a href="'.route('payment.form', $model->id).'" class="btn btn-primary btn-sm modal-show" name="'.$model->no_regis.'">Make</a>';
                    return $button;
                }
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }

    public function receipt()
    {
        return view('payment.receipt');
    }

    public function showReceipt($id)
    {
        $model = Payment::find($id);
        $price = Price::get();
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        // dd());
            // $time_start = Time::where('id',$time)->value('time_start');
        $model['datetime'] = $date.' '.$model->approves->times->name;
        // dd($model->created_at->format('Y-m-d'));
        // $model['date'] =  date('Y-m-d',$model->created_at);
        // $model['many'] = $request->many;
        // $model['service'] = Price::where('tool_id',$model->orders->tools_id)->pluck('service','id');
        return view('payment.showreceipt', ['model' => $model, 'price'=>$price]);
    }

    public function dataReceipt()
    {
        $model=Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->where('users_id', '=', Auth()->User()->id);
                        });
                    })->Where('status',6)
                    ->orWhereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->whereHas('users', function ($user){
                                return $user->whereHas('profiles', function ($profile){
                                    return $profile->where('email_lecturer', '=', Auth()->User()->email);
                                });
                            });
                        });
                    })->where('status',7);
            })->get();
        }
        else if($model->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                    return $query->whereHas('orders', function ($order){
                        return $order->where('users_id', '=', Auth()->User()->id);
                    });
                });
            })->where('status',6)->get();
        }
        else{
            abort(404);
        }
        return DataTables::of($model)
            ->editColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('user', function($model){
                return $model->approves->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->approves->orders->tools->name;
            })
            ->addColumn('date', function($model){
                $date = date('d M Y', strtotime($model->approves->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('payment.showReceipt', $model->id).'" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('approves_id')
            ->removeColumn('no_invoice')
            ->removeColumn('date_invoice')
            ->removeColumn('date_receipt')
            ->removeColumn('status')
            ->removeColumn('image')
            ->removeColumn('quantity')
            ->removeColumn('service')
            ->removeColumn('created_at')
            ->removeColumn('updated_at')
            ->addIndexColumn()
            ->rawColumns(['show'])
            ->make(true);
    }

    public function datatableReceipt()
    {
        $model = Payment::where(function($model){
            $model->where('status',1)
                ->orWhere('status',4)
                ->orWhere('status',5);
        })->get();
        return DataTables::of($model)
            ->editColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('no_regis', function($model){
                return $model->approves->no_regis;
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->approves->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('user', function($model){
                return $model->approves->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->approves->orders->tools->name;
            })
            ->addColumn('lecturer', function($model){
                return $model->approves->orders->users->profiles->email_lecturer;
            })
            ->addColumn('plan', function($model){
                return $model->approves->orders->plans->name;
            })
            ->addColumn('attend', function($model){
                if ($model->approves->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('purpose', function($model){
                return $model->approves->orders->purpose;
            })
            ->addColumn('sample', function($model){
                return $model->approves->orders->sample;
            })
            ->addColumn('unique', function($model){
                return $model->approves->orders->unique;
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('payment.updateReceipt', $model->id).'" class="btn btn-primary btn-sm receipt" name="'.$model->no_regis.'">Receipt</a>';
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

    public function updateReceipt($id)
    {
        $model = Payment::find($id);
        if($model->status==1||$model->status==4||$model->status==5){
            $no = Payment::orderBy('id', 'desc')->value('id');
            $payment['date_receipt'] = date('Y-m-d');
            // $payment['date_receipt'] = date("/m/Y");
            if($no == NULL){
                $no = 1;
                $payment['no_receipt'] = $no.'/'.$model->approves->orders->tools->labs->code.'/'.$model->approves->orders->tools->code.'/'.$payment['date_receipt'];
            }
            else{
                $no+=1;
                $payment['no_receipt'] = $no.'/'.$model->approves->orders->tools->labs->code.'/'.$model->approves->orders->tools->code.'/'.$payment['date_receipt'];
            }
            if($model->status==1||$model->status==4){
                $payment['status'] = 6;
            }
            else if($model->status==5){
                $payment['status'] = 7;
            }
            else{
                return response()->json(error);
            }
            // $save = Approve::where('id', $model->approves_id)->update([
            //     'status' => 3
            // ]);
            $save = Payment::findOrFail($id)->update($payment);
            return response()->json($save);
        }
        else{
            return response()->json(error);
        }
    }

    public function history()
    {
        return view('payment.history');
    }

    public function datatableHistory()
    {
        $model=Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->where('users_id', '=', Auth()->User()->id);
                        });
                    })->Where('status',8)
                    ->orWhereHas('approves', function ($query){
                        return $query->whereHas('orders', function ($order){
                            return $order->whereHas('users', function ($user){
                                return $user->whereHas('profiles', function ($profile){
                                    return $profile->where('email_lecturer', '=', Auth()->User()->email);
                                });
                            });
                        });
                    })->where('status',9);
            })->get();
        }
        else if($model->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad|User Umum')){
            $model = Payment::where(function($model){
                $model->whereHas('approves', function ($query){
                    return $query->whereHas('orders', function ($order){
                        return $order->where('users_id', '=', Auth()->User()->id);
                    });
                });
            })->where('status',8)->get();
        }
        else if($model->hasRole('Admin')){
            $model = Payment::where(function($model){
                $model->where('status',8)
                    ->orWhere('status',9);
            })->get();
        }
        else{
            abort(404);
        }
        return DataTables::of($model)
            ->addColumn('user', function($model){
                return $model->approves->orders->users->name;
            })
            ->addColumn('tool', function($model){
                return $model->approves->orders->tools->name;
            })
            ->addColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('plan', function($model){
                $plan = $model->approves->orders->plans->name;
                if($plan=='Tunai'){
                    return $plan;
                }
//                 else if($model->image!=NULL){
//                     $button = 
// '<p>'.$plan.'</p><a href="#" class="btn btn-primary btn-sm details-control">Show Image</a>&nbsp;
// <a href="'.route('payment.formUpload', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Upload Bukti Transfer">Reupload</a>';
//                     return $button;
//                 }
                else{
                    $button = 
'<p>'.$plan.'</p><a href="#" class="btn btn-primary btn-sm details-control">Show Image</a>';
                    return $button;
                }
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('status', function($model){
                if($model->status==2){
                    return 'Completed';
                }
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('payment.showHistory', $model->id).'" class="btn btn-primary btn-sm" name="'.$model->no_regis.'">show</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['plan'])
            ->make(true);
    }
}
