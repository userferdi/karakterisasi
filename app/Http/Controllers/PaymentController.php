<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Payment;
use App\Price;

use PDF;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    public function coba()
    {
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
        if($model->status==1 || $model->status==2 || $model->status==3){
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
        // $model['image'] = NULL;
        $date = date("Y/m");
        if($request->file('image')!=null){
            $directory = '/upload/proof/'.$date.'/';
            $filename = $model->id.'-'.$model->approves->orders->tools->labs->code.'-'.$model->approves->orders->tools->code.'-'.$model->approves->orders->users->name.'.'.$request->image->getClientOriginalExtension();
            $model['image'] = $directory.$filename;
            $request->image->move(public_path($directory), $filename);
        }
        $save = $model->update();
        if($save==true){
            $save = Payment::find($id)->update([
                'status' => 3,
            ]);
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
        $model['many'] = $request->many;
        $model['service'] = Price::where('tools_id',$model->orders->tools_id)->pluck('service','id');
        return view('payment.formbill', ['model' => $model]);
    }

    public function showBill($id)
    {
        $model = Payment::find($id);
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
        return view('payment.showbill', ['model' => $model]);
    }

    public function updateBill(Request $request, $id)
    {
        $model = Approve::find($id);
        if($model->status == 1){
            $payment = new Payment;
            $no = Payment::orderBy('id', 'desc')->value('id');
            $date = date("/m/Y");
            if($no == NULL){
                $no = 1;
                $payment['no_invoice'] = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code.$date;
            }
            else{
                $no+=1;
                $payment['no_invoice'] = $no.'/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code.$date;
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
                $payment['status'] = 2;
            }
            else{
                $payment['status'] = 1;
            }
            $save = $payment->save();
            return response()->json($save);
        }
        else{
            abort(404);
        }
    }

        // $your_string = '2 3 12 34 ';
        // $array = str_split($your_string);
        // $i=0; $j=0; $k=0; $l=0;
        // foreach ($array as $char){
        //     if($char == ' '){
        //         $no[$k] = 0;
        //         for($j=$l;$j<$i;$j++){
        //             if(empty($no[$k])){
        //                 $no[$k] = $array[$j];
        //             }
        //             else{
        //                 $no[$k] .= $array[$j];
        //             }
        //         }
        //         $l=$i+1;
        //         $k++;
        //     }
        //     $i++;
        // }

        // dd($no,$array);

    public function dataBill()
    {
        $model = Payment::whereHas('approves', function ($query){
            return $query->whereHas('orders', function ($order){
                return $order->where('users_id', '=', Auth()->User()->id);
            });
        })->where(function($model){
            $model->where('status',1)
                ->orWhere('status',3);
        })->get();
        return DataTables::of($model)
            ->addColumn('no_regis', function($model){
                return $model->approves->no_regis;
            })
            ->editColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('date', function($model){
                $date = date('d M Y', strtotime($model->approves->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('tool', function($model){
                return $model->approves->orders->tools->name;
            })
            ->addColumn('plan', function($model){
                return $model->approves->orders->plans->name;
            })
            ->addColumn('upload', function($model){
                if($model->image!=NULL){
                    $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Show Image</a>
<a href="'.route('payment.formUpload', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Upload Bukti Transfer">Reupload</a>';
                    return $button;
                }
                $button = 
'<a href="'.route('payment.formUpload', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Upload Bukti Transfer">Upload</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('payment.showBill', $model->id).'" class="btn btn-primary btn-sm">Invoice</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend','detail','upload','action'])
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
                $button = 
'<a href="'.route('payment.form', $model->id).'" class="btn btn-primary btn-sm modal-show" name="'.$model->no_regis.'">Invoice</a>';
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

    public function receipt()
    {
        return view('payment.receipt');
    }

    public function dataReceipt()
    {
        $model = Payment::where('status',4)->get();
        return DataTables::of($model)
            ->addColumn('no_regis', function($model){
                return $model->approves->no_regis;
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->approves->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
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

    public function datatableReceipt()
    {
        $model = Payment::where('status',3)->get();
        return DataTables::of($model)
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
        if($model->status==3){
            $save = Approve::where('id', $model->approves_id)->update([
                'status' => 2
            ]);
            $no = Payment::orderBy('id', 'desc')->value('id');
            $date = date("/m/Y");
            if($no == NULL){
                $no = 1;
                $payment['no_receipt'] = $no.'/'.$model->approves->orders->tools->labs->code.'/'.$model->approves->orders->tools->code.$date;
            }
            else{
                $no+=1;
                $payment['no_receipt'] = $no.'/'.$model->approves->orders->tools->labs->code.'/'.$model->approves->orders->tools->code.$date;
            }
            $payment['status'] = 4;
            $save = Payment::findOrFail($id)->update($payment);
            return response()->json($save);
        }
        else{
            abort(404);
        }
    }

    public function history()
    {
        return view('payment.history');
    }

    public function dataHistory()
    {
        $model = Approve::where('status',2)->get();
        return DataTables::of($model)
            ->addColumn('tool', function($model){
                return $model->orders->tools->name;
            })
            ->addColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->payments->total, 0, ',', '.');
                return $total;
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->times->name;
                return $date.' '.$time;
            })
            ->addColumn('status', function($model){
                if($model->status==2){
                    return 'Completed';
                }
            })
            ->addColumn('plan', function($model){
                return $model->orders->plans->name;
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
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }

}
