<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Payment;
use App\Price;
use App\Plan;
use App\Order;
use App\Cost;

use PDF;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
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
        if($model->status==1|$model->status==2){
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
            if($model->status==2){
                $save = Payment::find($id)->update([
                    'status' => 4
                ]);
                $mail = new PHPMailer(true);
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress('support.finder@unpad.ac.id');
                    $mail->Subject = 'Telah Melakukan Pembayaran';

                if($model->orders->users->hasRole('User Umum')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else if($model->orders->users->hasRole('Dosen Unpad')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else{
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                    $mail->isHTML(true);
                    $mail->Send();
                }catch (Exception $e) {
                    return response()->json(error);
                }


            }
            if($model->status==3){
                $save = Payment::find($id)->update([
                    'status' => 5
                ]);
                $mail = new PHPMailer(true);
                try{
                    $mail->Encoding = 'base64';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'functionalnanopowder@gmail.com';
                    $mail->Password = '1w3r!W#R';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                    $mail->AddAddress('support.finder@unpad.ac.id');
                    $mail->Subject = 'Telah Melakukan Pembayaran';
                if($model->orders->users->hasRole('User Umum')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama : <b>'.$model->orders->users->name.'</b></p>
<p>No ID : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Institusi : <b>'.$model->orders->users->profiles->institution.'</b></p>
<p>Alamat : <b>'.$model->orders->users->profiles->address.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else if($model->orders->users->hasRole('Dosen Unpad')){
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama Dosen : <b>'.$model->orders->users->name.'</b></p>
<p>NIDN : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                else{
                    $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad menerima <b>pembayaran</b> penggunaan alat dari:</p><br>
<p>Nama Mahasiswa : <b>'.$model->orders->users->name.'</b></p>
<p>NIM : <b>'.$model->orders->users->profiles->no_id.'</b></p>
<p>Email : <b>'.$model->orders->users->email.'</b></p>
<p>Program Studi : <b>'.$model->orders->users->profiles->study_program.'</b></p>
<p>Fakultas : <b>'.$model->orders->users->profiles->faculty.'</b></p>
<p>Universitas : <b>'.$model->orders->users->profiles->university.'</b></p><br>
<p>Penggunaan Alat : <b>'.$model->orders->tools->name.'</b></p>
<p>Jadwal Penggunaan Alat : <b>'.$date.'</b></p><br>
<p>Anda sebagai Admin diminta untuk memverifikasi pembayaran dan membuat receipt.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                }
                    $mail->isHTML(true);
                    $mail->Send();
                }catch (Exception $e) {
                    return response()->json(error);
                }

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
        $model['total'] = 0;
        foreach($model->costs as &$cost){
            $model['total'] += $cost->price*$cost->quantity;
        }
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        $model['datetime'] = $date.' '.$model->approves->times->name;
        return view('payment.showbill', ['model' => $model]);
    }

    public function pdfBill($id)
    {
        $model = Payment::find($id);
        $model['total'] = 0;
        foreach($model->costs as &$cost){
            $model['total'] += $cost->price*$cost->quantity;
        }
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        $model['datetime'] = $date.' '.$model->approves->times->name;
        $pdf = PDF::loadview('payment.streambill', ['model' => $model]);
        return $pdf->stream();
    }

    public function updateBill(Request $request, $id)
    {
        $model = Approve::find($id);
        if($model->status == 1){
            $save = Order::where('id', $model->orders_id)->update([
                'plans_id' => $request->plans_id
            ]);

            $payment = new Payment;
            $no = Payment::whereHas('approves', function ($query) use ($model){
                return $query->whereHas('orders', function ($query) use ($model){
                    return $query->where('tools_id', '=', $model->orders->tools->id);
                });
            })->get('id')->count();
            $payment['date_invoice'] = date('Y-m-d');
            $no+=1;
            $payment['no_invoice'] = $no.'/INV/'.$model->orders->tools->labs->code.'/'.$model->orders->tools->code.date('/m/Y');

            if($model->orders->plans_id == 1){
                $payment['status'] = 1;
            }
            else if($model->orders->plans_id == 2){
                $payment['status'] = 2;
            }
            else{
                $payment['status'] = 3;
            }
            $payment['approves_id'] = $id;
            $save = $payment->save();
            $idPayment = DB::getPdo()->lastInsertId();

            for($i=0; $i<$request->many; $i++){
                $profile = Cost::create([
                    'payments_id' => $idPayment,
                    'service' => $request->service[$i],
                    'price' => $request->price[$i],
                    'quantity' => $request->quantity[$i]
                ]);
            }

            $save = Approve::findOrFail($id)->update([
                'status' => 2
            ]);

            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Menunggu Pembayaran Penggunaan Alat';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Permintaan penggunaan alat Anda telah dilakukan.</p>
<p>Harap untuk segera melakukan pembayaran</p><br>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website FiNder melalui akun Anda dengan link berikut: <a href="'.route('login').'">login!</a></p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
            return response()->json($save);
        }
        if($model->status==2){
            $save = Order::where('id', $model->orders_id)->update([
                'plans_id' => $request->plans_id
            ]);

            if($model->orders->plans_id == 1){
                $payment['status'] = 1;
            }
            else if($model->orders->plans_id == 2){
                $payment['status'] = 2;
            }
            else{
                $payment['status'] = 3;
            }
            $payment = Payment::find($model->payments->id)->update($payment);

            $cost = Cost::where('payments_id', $model->payments->id)->delete();
            for($i=0; $i<$request->many; $i++){
                $profile = Cost::create([
                    'payments_id' => $model->payments->id,
                    'service' => $request->service[$i],
                    'price' => $request->price[$i],
                    'quantity' => $request->quantity[$i]
                ]);
            }
            return response()->json($save);
        }
        else{
            return response()->json(error);
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
                                ->orWhere('status',4)
                                ->orWhere('status',6);
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
                                ->orWhere('status',5)
                                ->orWhere('status',7);
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
                    ->orWhere('status',4)
                    ->orWhere('status',6);
            })->get();
        }
        else{
            abort(404);
        }
        return DataTables::of($model)
            ->editColumn('total', function($model){
                $model['total'] = 0;
                foreach($model->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
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
                else if($model->status==6||$model->status==7){
                    $button = '<p>'.$plan.'</p><a href="'.$model->image.'" target="_blank" class="btn btn-primary btn-sm details-control">Lihat Bukti Transfer</a>';
                    return $button;
                }
                else if($model->image!=NULL){
                    $button =
'<p>'.$plan.'</p><a href="'.$model->image.'" target="_blank" class="btn btn-primary btn-sm details-control">Lihat</a>&nbsp;
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
'<a href="'.route('payment.showBill', $model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('approves_id')
            ->removeColumn('no_receipt')
            ->removeColumn('date_invoice')
            ->removeColumn('date_receipt')
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

        $model = Approve::where(function($model){
            $model->where('status',1)
                  ->orWhere('status',2)
                  ->orWhere('status',3);
        })->get();
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
                if($model->payments()->exists()){
                    if($model->payments->status==1|$model->payments->status==2|$model->payments->status==3){
                        $button =
'<a href="'.route('payment.form', $model->id).'" class="btn btn-primary btn-sm modal-show" name="'.$model->no_regis.'">Edit</a>
<a href="'.route('payment.showBill', $model->payments->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                        return $button;
                    }
                    else{
                        $button =
'<a href="'.route('payment.showBill', $model->payments->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                        return $button;
                    }
                }
                else{
                    $button =
'<a href="'.route('payment.form', $model->id).'" class="btn btn-primary btn-sm modal-show" name="'.$model->no_regis.'">Buat Tagihan</a>';
                    return $button;
                }
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action', 'plan'])
            ->make(true);
    }

    public function receipt()
    {
        return view('payment.receipt');
    }

    public function showReceipt($id)
    {
        $model = Payment::find($id);
        $model['total'] = 0;
        foreach($model->costs as &$cost){
            $model['total'] += $cost->price*$cost->quantity;
        }
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        $model['datetime'] = $date.' '.$model->approves->times->name;
        return view('payment.showreceipt', ['model' => $model]);
    }

    public function pdfReceipt($id)
    {
        $model = Payment::find($id);
        $model['total'] = 0;
        foreach($model->costs as &$cost){
            $model['total'] += $cost->price*$cost->quantity;
        }
        if($model->approves->orders->plans_id == 3){
            $email_lecturer = $model->approves->orders->users->profiles->email_lecturer;
            $model['name'] = User::where('email',$email_lecturer)->value('name');
        }
        else{
            $model['name'] = $model->approves->orders->users->name;
        }
        $date = date('d F Y',strtotime($model->approves->date));
        $model['datetime'] = $date.' '.$model->approves->times->name;
        $pdf = PDF::loadview('payment.streamreceipt', ['model' => $model]);
        return $pdf->stream();
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
                $model['total'] = 0;
                foreach($model->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
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
'<a href="'.route('payment.showReceipt', $model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
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
                ->orWhere('status',5)
                ->orWhere('status',6)
                ->orWhere('status',7);
        })->get();
        return DataTables::of($model)
            ->editColumn('total', function($model){
                $model['total'] = 0;
                foreach($model->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->editColumn('image', function($model){
                if($model->approves->orders->plans->id==1){
                    return ' ';
                }
                return '<a href="'.$model->image.'" target="_blank"><img src="'.$model->image.'" width="300"/></a>';
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
                if($model->status==6|$model->status==7){
                    $button =
'<a href="'.route('payment.showReceipt', $model->id).'" class="btn btn-primary btn-sm">Lihat</a>';
                    return $button;
                }
                else{
                    $button =
'<a href="'.route('payment.updateReceipt', $model->id).'" class="btn btn-primary btn-sm receipt" name="'.$model->no_regis.'">Buat</a>';
                    return $button;
                }
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['image', 'attend', 'detail', 'action'])
            ->make(true);
    }

    public function updateReceipt($id)
    {
        $model = Payment::find($id);
        if($model->status==1||$model->status==4||$model->status==5){
            $no = Payment::whereHas('approves', function ($query) use ($model){
                return $query->whereHas('orders', function ($query) use ($model){
                    return $query->where('tools_id', '=', $model->approves->orders->tools->id);
                });
            })->where('no_receipt', '!=', NULL)->get('id')->count();
            $payment['date_receipt'] = date('Y-m-d');
            $no+=1;
            $payment['no_receipt'] = $no.'/RCP/'.$model->approves->orders->tools->labs->code.'/'.$model->approves->orders->tools->code.date('/m/Y');
            if($model->status==1||$model->status==4){
                $payment['status'] = 6;
            }
            else if($model->status==5){
                $payment['status'] = 7;
            }
            else{
                return response()->json(error);
            }
            $save = Approve::where('id', $model->approves_id)->update([
                'status' => 3
            ]);
            $save = Payment::findOrFail($id)->update($payment);
            $mail = new PHPMailer(true);
            try{
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FiNder');
                $mail->AddAddress($model->orders->users->email);
                $mail->Subject = 'Pembayaran Sukses';
                $mail->Body = '
<p>Sistem Informasi Pengelolaan Layanan Functional Nano Powder (FiNder) Unpad</p><br>
<p>Pembayaran Anda telah kami terima.</p>
<p>Terima kasih telah menggunakan layanan kami</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat FiNder</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
            }catch (Exception $e) {
                return response()->json(error);
            }
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
                $model->where('status',1)
                    ->orWhere('status',2)
                    ->orWhere('status',3)
                    ->orWhere('status',4)
                    ->orWhere('status',5)
                    ->orWhere('status',6)
                    ->orWhere('status',7)
                    ->orWhere('status',8)
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
                $model['total'] = 0;
                foreach($model->costs as &$cost){
                    $model['total'] += $cost->price*$cost->quantity;
                }
                $total = 'Rp ';
                $total .= number_format($model->total, 0, ',', '.');
                return $total;
            })
            ->addColumn('plan', function($model){
                $plan = $model->approves->orders->plans->name;
                if($plan=='Tunai'){
                    return $plan;
                }
                else{
                    $button =
'<p>'.$plan.'</p><a href="'.$model->image.'" class="btn btn-primary btn-sm details-control" target="_blank">Show Image</a>';
                    return $button;
                }
            })
            ->editColumn('date', function($model){
                $date = date('d M Y', strtotime($model->date));
                $time = $model->approves->times->name;
                return $date.' '.$time;
            })
            ->addColumn('status', function($model){
                if($model->status==2|$model->status==3){
                    return 'Menunggu transaksi client';
                }
                if($model->status==1|$model->status==4|$model->status==5){
                    return 'Menunggu pembuatan receipt';
                }
                if($model->status==6|$model->status==7){
                    return 'Menunggu verifikasi akhir';
                }
                if($model->status==8|$model->status==9){
                    return 'Completed';
                }
            })
            ->addColumn('show', function($model){
                $button =
'<a href="'.route('payment.showBill', $model->id).'" class="btn btn-primary btn-sm">Bill</a>
<a href="'.route('payment.showReceipt', $model->id).'" class="btn btn-primary btn-sm">Receipt</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['plan','show'])
            ->make(true);
    }
}