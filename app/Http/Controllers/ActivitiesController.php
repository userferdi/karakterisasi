<?php

namespace App\Http\Controllers;

use App\Approve;
use App\Booking;
use App\Lab;
use App\Order;
use App\Payment;
use App\Plan;
use App\Price;
use App\Profile;
use App\Time;
use App\Tool;
use App\Usage;
use App\User;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }

    public function showform()
    {
        return view('activities.showform');
    }

    public function dataform()
    {
        $model = Tool::get();
        return DataTables::of($model)
            ->addColumn('register', function($model){
                $button = 
'<a href="'.route('activities.create',$model->id).'" class="btn btn-primary btn-sm">Registrasi</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['register'])
            ->make(true);
    }

	public function create($id)
	{
        $model = new Order();
        $tool = Tool::where('id',$id)->get();
        $model['tool'] = $tool->pluck('name', 'id');
        if(Auth()->User()->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){
            $model['plan'] = Plan::pluck('name', 'id');
        }
        else{
            $plan = Plan::get();
            $model['plan'] = $plan->reject(function ($query){
                return $query->id > 2;
            })->pluck('name', 'id');
        }
        $model['time'] = Time::leftJoin('time_usage', 'time_usage.time_id', '=', 'times.id')
            ->where('usage_id',$tool[0]->usages_id)->get()->sortBy('time_id')->pluck('name','time_id');
        return view('activities.create', ['model' => $model]);
	}

    public function store(Request $request)
    {
        $this->validate($request, [
            'tools_id' => 'required',
            'plans_id' => 'required',
            'purpose' => 'required',
            'sample' => 'required',
            'unique' => 'required'
        ]);

        $order = new Order;
        $booking = new Booking;

        $tool = Tool::where('id',$request->tools_id)->first();
        $no = Order::where('tools_id', $request->tools_id)->get('id')->count();
        $no+=1;
        $booking['no_form'] = $no.'/'.$tool->labs->code.'/'.$tool->code;

        $id = Order::create([
            'users_id' => Auth()->User()->id,
            'tools_id' => $request->tools_id,
            'attend' => $request->attend,
            'plans_id' => $request->plans_id,
            'purpose' => $request->purpose,
            'sample' => $request->sample,
            'unique' => $request->unique
        ]);
        $id = DB::getPdo()->lastInsertId();
        $booking['orders_id'] = $id;
        $booking['date1'] = $request['date1'];
        $booking['date2'] = $request['date2'];
        $booking['date3'] = $request['date3'];
        $booking['times1_id'] = $request['times1_id'];
        $booking['times2_id'] = $request['times2_id'];
        $booking['times3_id'] = $request['times3_id'];
        $token = str::random(60);
        $booking['token'] = $token;
        $save = $booking->save();
        if($save == true){
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            try{
                // $mail->SMTPOptions = array(
                //     'ssl' => array(
                //         'verify_peer' => false,
                //         'verify_peer_name' => false,
                //         'allow_self_signed' => true
                //     )
                // );
                // $mail->SMTPDebug = true;
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'functionalnanopowder@gmail.com';
                $mail->Password = '1w3r!W#R';
                // SSL: 465, TLS: 587
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->SetFrom('functionalnanopowder@gmail.com', 'FINDER');
                $mail->AddAddress(Auth()->User()->email);
                $mail->Subject = 'Permintaan Verifikasi Booking Alat';
                $mail->Body = '
<p>Functional Nano Powder (FINDER) Unpad menerima permintaan penggunaan alat dari Anda.</p>
<p>Sebelum melanjutkan proses pemesanan, kami perlu memastikan bahwa ini memang Anda.</p>
<p>Klik tautan berikut untuk memverifikasi: <a href="'.route('verify',$token).'">di sini!</a></p><br>
<p>Untuk melihat detail pemesanan silahkan Log-In ke Website SIPA Finder melalui akun Anda dengan link berikut: <a href="'.route('status.booking').'">login!</a></p>
<p>Silahkan Masuk ke Menu <strong>My Activities -> Registration of Tool Usage</strong> untuk melakukan verifikasi terhadap permintaan penggunaan alat dari mahasiswa Anda.</p>
<p>Jika bukan Anda yang melakukan transaksi tersebut, harap mengabaikan pesan ini.</p><br>
<p>Hormat Kami,</p>
<p>Sekretariat SIPA FINDER</p>
<p>Jl. Raya Bandung-Sumedang KM. 21 Jawa Barat 45363.</p>';
                $mail->isHTML(true);
                $mail->Send();
                return redirect()->route('status.booking');
            }catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
        else{
            return redirect()->route('activities.create',$request['tools_id']);
        }
    }

    public function edit($id)
    {
        $model = Order::findOrFail($id);
        $model['approve'] = Approve::all()->pluck('name', 'id');
        return view('activities.statusform', ['model' => $model]);
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

    public function booking()
    {
        return view('activities.status.booking');
    }

    public function lecturer()
    {
        return view('activities.status.lecturer');
    }

    public function confirmation()
    {
        return view('activities.status.confirmation');
    }

    public function reschedule()
    {
        return view('activities.status.reschedule');
    }

    public function approved()
    {
        return view('activities.status.approved');
    }

    public function rejected()
    {
        return view('activities.status.rejected');
    }

    public function canceled()
    {
        return view('activities.status.canceled');
    }

    public function completed()
    {
        if(Auth()->User()->hasRole('Admin')){
            return view('activities.status.complete');
        }
        else{
            abort(404);
        }
    }

    public function datatableBooking()
    {
        $model = Booking::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where(function($model){
            $model->where('status',1)
                ->orWhere('status',2)
                ->orWhere('status',3);
        })->get();
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
            ->editColumn('status', function($model){
                if ($model->status == 1){
                    return 'Menunggu konfirmasi pada email Anda';
                }
                else if ($model->status == 2){
                    return 'Menunggu konfirmasi dari Dosen Pembimbing Anda';
                }
                else if ($model->status == 3){
                    return 'Menunggu konfirmasi dari Admin';
                }
            })
            ->addColumn('resend', function($model){
                $button = 
'<a href="'.route('verify.resend', $model->id).'" class="btn btn-primary btn-sm resend">Resend</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                if ($model->status == 1){
                    $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>
<a href="'.route('verify.updateCancel', $model->id).'" class="btn btn-danger btn-sm cancel" name="'.$model->no_form.'">Cancel</a>';
                    return $button;
                }
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
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
            ->rawColumns(['attend', 'resend', 'action'])
            ->make(true);
    }

    public function datatableConfirmation()
    {
        $model = Booking::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where('status',4)->get();
        return DataTables::of($model)
            ->editColumn('date', function($model){
                if($model->datetime == 1){
                    $date = date('d M Y', strtotime($model->date1));
                    $time = $model->times1->name;
                    return $date.' '.$time;
                }
                else if($model->datetime == 2){
                    $date = date('d M Y', strtotime($model->date2));
                    $time = $model->times2->name;
                    return $date.' '.$time;
                }
                else if($model->datetime == 3){
                    $date = date('d M Y', strtotime($model->date3));
                    $time = $model->times3->name;
                    return $date.' '.$time;
                }
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
            ->addColumn('confirm', function($model){
                $button = 
'<a href="'.route('verify.updateConfirm', $model->id).'" class="btn btn-primary btn-sm confirm" name="'.$model->no_form.'">Confirm</a>';
                return $button;
            })
            ->addColumn('cancel', function($model){
                $button = 
'<a href="'.route('verify.updateCancel', $model->id).'" class="btn btn-danger btn-sm cancel" name="'.$model->no_form.'">Cancel</a>';
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
            ->rawColumns(['attend', 'detail', 'confirm', 'cancel'])
            ->make(true);
    }

    public function datatableReschedule()
    {
        $model = Booking::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where('status',5)->get();
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
            ->addColumn('lecturer', function($model){
                return $model->orders->users->profiles->email_lecturer;
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
            ->addColumn('attend', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->addColumn('confirm', function($model){
                $button = 
'<a href="'.route('verify.showReschedule', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Reschedule: '.$model->no_form.'">Reschedule</a>';
                return $button;
            })
            ->addColumn('cancel', function($model){
                $button = 
'<a href="'.route('verify.updateCancel', $model->id).'" class="btn btn-danger btn-sm cancel" name="'.$model->no_form.'">Cancel</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times1_id')
            ->removeColumn('times2_id')
            ->removeColumn('times3_id')
            ->removeColumn('users_id')
            ->removeColumn('token')
            // ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'confirm', 'cancel'])
            ->make(true);
    }

    public function datatableApproved()
    {
        $model = Approve::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where(function($model){
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
            ->addColumn('purpose', function($model){
                return $model->orders->purpose;
            })
            ->addColumn('sample', function($model){
                return $model->orders->sample;
            })
            ->addColumn('unique', function($model){
                return $model->orders->unique;
            })
            ->addColumn('attend', function($model){
                if ($model->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times_id')
            ->removeColumn('users_id')
            ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail'])
            ->make(true);
    }

    public function datatableRejected()
    {
        $model = Booking::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where(function($model){
            $model->where('status',7)
                  ->orWhere('status',8);
        })->get();
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
            ->addColumn('lecturer', function($model){
                return $model->orders->users->profiles->email_lecturer;
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
            ->editColumn('status', function($model){
                if ($model->status == 7){
                    return 'Rejected by Lecturer';
                }
                else if ($model->status == 8){
                    return 'Rejected by Admin';
                }
            })
            ->addColumn('attend', function($model){
                if ($model->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times1_id')
            ->removeColumn('times2_id')
            ->removeColumn('times3_id')
            ->removeColumn('users_id')
            ->removeColumn('token')
            // ->removeColumn('note')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail'])
            ->make(true);
    }

    public function datatableCanceled()
    {
        $model = Booking::whereHas('orders', function ($query){
            return $query->where('users_id', '=', Auth()->User()->id);
        })->where('status',9)->get();
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
            ->addColumn('lecturer', function($model){
                return $model->orders->users->profiles->email_lecturer;
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
            ->addColumn('attend', function($model){
                if ($model->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->editColumn('status', function($model){
                return 'Canceled';
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
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
            ->rawColumns(['attend', 'detail'])
            ->make(true);
    }

    public function adminBooking()
    {
        $model = Booking::where('status',3)->get();
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
            ->addColumn('lecturer', function($model){
                $lecturer = User::where('email',$model->orders->users->profiles->email_lecturer)->value('name');
                return $lecturer;
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
            ->editColumn('status', function($model){
                if ($model->status == 1){
                    return 'Menunggu konfirmasi pada email Anda';
                }
                else if ($model->status == 2){
                    return 'Menunggu konfirmasi dari Dosen Pembimbing Anda';
                }
                else if ($model->status == 3){
                    return 'Menunggu konfirmasi dari Admin';
                }
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->addColumn('action', function($model){
                $button = 
'<a href="'.route('verify.showConfirm', $model->id).'" class="btn btn-primary btn-sm modal-show" name="Confirm: '.$model->no_form.'">Confirm</a>
<a href="'.route('verify.showReschedule', $model->id).'" class="btn btn-warning btn-sm modal-show" name="Reschedule: '.$model->no_form.'">Reschedule</a>
<a href="'.route('verify.showReject', $model->id).'" class="btn btn-danger btn-sm modal-show" name="Reject: '.$model->no_form.'">Reject</a>';
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

    public function adminApproved()
    {
        $model = Approve::where(function($model){
            $model->where('status',1)
                  ->orWhere('status',2);
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
            ->addColumn('purpose', function($model){
                return $model->orders->purpose;
            })
            ->addColumn('sample', function($model){
                return $model->orders->sample;
            })
            ->addColumn('unique', function($model){
                return $model->orders->unique;
            })
            ->addColumn('attend', function($model){
                if ($model->orders->attend == NULL){
                    return '<i class="fas fa-times"></i>';
                }
                return '<i class="fas fa-check"></i>';
            })
            ->editColumn('status', function($model){
                if ($model->status == 1){
                    return 'Menunggu konfirmasi pada email Anda';
                }
                else if ($model->status == 2){
                    return 'Menunggu konfirmasi dari Dosen Pembimbing Anda';
                }
                else if ($model->status == 3){
                    return 'Menunggu konfirmasi dari Admin';
                }
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
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

    public function adminRejected()
    {
        $model = Booking::where(function($model){
            $model->where('status',7)
                  ->orWhere('status',8);
        })->get();
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
            ->addColumn('lecturer', function($model){
                $lecturer = User::where('email',$model->orders->users->profiles->email_lecturer)->value('name');
                return $lecturer;
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
            ->editColumn('status', function($model){
                if ($model->status == 7){
                    return 'Rejected by Lecturer';
                }
                else if ($model->status == 8){
                    return 'Rejected by Admin';
                }
            })
            ->addColumn('detail', function($model){
                $button = 
'<a href="#" class="btn btn-primary btn-sm details-control">Detail</a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('times1_id')
            ->removeColumn('times2_id')
            ->removeColumn('times3_id')
            ->removeColumn('users_id')
            ->removeColumn('token')
            ->addIndexColumn()
            ->rawColumns(['attend', 'detail', 'action'])
            ->make(true);
    }

    public function datatableCompleted()
    {
        $model = Approve::where('status',3)->get();
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
            ->addColumn('plan', function($model){
                return $model->orders->plans->name;
            })
            ->editColumn('total', function($model){
                $total = 'Rp ';
                $total .= number_format($model->payments->total, 0, ',', '.');
                return $total;
            })
            // ->editColumn('status', function($model){
            //     return 'Menunggu konfirmasi pada email Anda';
            // })
            ->addColumn('confirm', function($model){
                $button = 
'<a href="'.route('status.updateCompleted', $model->id).'" class="btn btn-primary btn-sm confirm" name="'.$model->no_regis.'">Confirm</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['confirm'])
            ->make(true);
    }

    public function updateCompleted(Request $request, $id)
    {
        $model = Approve::findOrFail($id);
        if($model->status==3){
            $save = $model->update([
                'status' => 4
            ]);
            if($model->payments->status==6){
                $save = Payment::where('id',$model->payments->id)->update([
                    'status' => 8
                ]);
            }
            if($model->payments->status==7){
                $save = Payment::where('id',$model->payments->id)->update([
                    'status' => 9
                ]);
            }
            return response()->json($save);
        }
        else{
            abort(404);
        }
    }
}
