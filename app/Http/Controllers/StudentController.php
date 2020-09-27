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
                if($faculty == ('Fakultas Matematika dan Ilmu Pengetahuan Alam' || 'Matematika dan Ilmu Pengetahuan Alam')){
                    $faculty = 'FMIPA';
                }
                else if($faculty == ('Fakultas Ekologi Manusia' || 'Ekologi Manusia')){
                    $faculty = 'FEMA';
                }
                else if($faculty == ('Fakultas Ilmu dan Teknologi Kebumian' || 'Ilmu dan Teknologi Kebumian')){
                    $faculty = 'FITB';
                }
                else if($faculty == ('Fakultas Ilmu Komputer' || 'Ilmu Komputer')){
                    $faculty = 'FASILKOM';
                }
                else if($faculty == ('Fakultas Kehutanan' || 'Kehutanan')){
                    $faculty = 'FAHUTAN';
                }
                else if($faculty == ('Fakultas Perikanan dan Ilmu Kelautan' || 'Perikanan dan Ilmu Kelautan')){
                    $faculty = 'FPIK';
                }
                else if($faculty == ('Fakultas Pertanian' || 'Pertanian')){
                    $faculty = 'FAPERTA';
                }
                else if($faculty == ('Fakultas Peternakan' || 'Kedokteran Peternakan')){
                    $faculty = 'FAPET';
                }
                else if($faculty == ('Fakultas Teknik Geologi' || 'Teknik Geologi')){
                    $faculty = 'FTG';
                }
                else if($faculty == ('Fakultas Teknik Ilmu Pertanian' || 'Teknik Ilmu Pertanian')){
                    $faculty = 'FTIP';
                }
                else if($faculty == ('Fakultas Teknik Mesin dan Dirgantara' || 'Teknik Mesin dan Dirgantara')){
                    $faculty = 'FTMD';
                }
                else if($faculty == ('Fakultas Teknik Pertambangan dan Perminyakan' || 'Teknik Pertambangan dan Perminyakan')){
                    $faculty = 'FTTM';
                }
                else if($faculty == ('Fakultas Teknik Sipil dan Lingkungan' || 'Teknik Sipil dan Lingkungan')){
                    $faculty = 'FTSL';
                }
                else if($faculty == ('Fakultas Teknik' || 'Teknik')){
                    $faculty = 'FT';
                }
                else if($faculty == ('Fakultas Teknologi Pertanian' || 'Teknologi Pertanian')){
                    $faculty = 'FATETA';
                }
                else if($faculty == ('Fakultas Teknologi Industri' || 'Teknologi Industri')){
                    $faculty = 'FTI';
                }
                else if($faculty == ('Fakultas Farmasi' || 'Farmasi')){
                    $faculty = 'FF';
                }
                else if($faculty == ('Fakultas Kedokteran Gigi' || 'Kedokteran Gigi')){
                    $faculty = 'FKG';
                }
                else if($faculty == ('Fakultas Kedokteran Hewan' || 'Kedokteran Hewan')){
                    $faculty = 'FKH';
                }
                else if($faculty == ('Fakultas Kedokteran' || 'Kedokteran')){
                    $faculty = 'FK';
                }
                else if($faculty == ('Fakultas Ilmu Keperawatan' || 'Ilmu Keperawatan')){
                    $faculty = 'FIK';
                }
                else if($faculty == ('Fakultas Keperawatan' || 'Keperawatan')){
                    $faculty = 'FKEP';
                }
                else if($faculty == ('Fakultas Kesehatan Masyarakat' || 'Kesehatan Masyarakat')){
                    $faculty = 'FKM';
                }
                else if($faculty == ('Fakultas Psikologi' || 'Psikologi')){
                    $faculty = 'FAPSI';
                }
                else if($faculty == ('Fakultas Ekonomi dan Bisnis' || 'Ekonomi dan Bisnis')){
                    $faculty = 'FEB';
                }
                else if($faculty == ('Fakultas Ekonomi dan Manajemen' || 'Ekonomi dan Manajemen')){
                    $faculty = 'FEM';
                }
                else if($faculty == ('Fakultas Ekonomi' || 'Ekonomi')){
                    $faculty = 'FE';
                }
                else if($faculty == ('Fakultas Hukum' || 'Hukum')){
                    $faculty = 'FH';
                }
                else if($faculty == ('Fakultas Ilmu Administrasi' || 'Ilmu Administrasi')){
                    $faculty = 'FIA';
                }
                else if($faculty == ('Fakultas Ilmu Budaya' || 'Ilmu Budaya')){
                    $faculty = 'FIB';
                }
                else if($faculty == ('Fakultas Ilmu Komunikasi' || 'Ilmu Komunikasi')){
                    $faculty = 'FIKOM';
                }
                else if($faculty == ('Fakultas Ilmu Sosial dan Ilmu Politik' || 'Ilmu Sosial dan Ilmu Politik')){
                    $faculty = 'FISIP';
                }
                else if($faculty == ('Fakultas Seni Rupa dan Desain' || 'Seni Rupa dan Desain')){
                    $faculty = 'FSRD';
                }
                else if($faculty == ('Fakultas Ilmu Pendidikan' || 'Ilmu Pendidikan')){
                    $faculty = 'FIP';
                }
                else if($faculty == ('Fakultas Pendidikan Bahasa dan Sastra' || 'Pendidikan Bahasa dan Sastra')){
                    $faculty = 'FPBS';
                }
                else if($faculty == ('Fakultas Pendidikan Ekonomi dan Bisnis' || 'Pendidikan Ekonomi dan Bisnis')){
                    $faculty = 'FPEB';
                }
                else if($faculty == ('Fakultas Pendidikan Ilmu Pengetahuan Sosial' || 'Pendidikan Ilmu Pengetahuan Sosial')){
                    $faculty = 'FPIPS';
                }
                else if($faculty == ('Fakultas Pendidikan Matematika dan Ilmu Pengetahuan Alam' || 'Pendidikan Matematika dan Ilmu Pengetahuan Alam')){
                    $faculty = 'FPMIPA';
                }
                else if($faculty == ('Fakultas Pendidikan Olahraga dan Kesehatan' || 'Pendidikan Olahraga dan Kesehatan')){
                    $faculty = 'FPOK';
                }
                else if($faculty == ('Fakultas Pendidikan Seni dan Desain' || 'Pendidikan Seni dan Desain')){
                    $faculty = 'FPSD';
                }
                else if($faculty == ('Fakultas Pendidikan Teknologi dan Kejuruan' || 'Pendidikan Teknologi dan Kejuruan')){
                    $faculty = 'FPTK';
                }
                else if($faculty == ('Sekolah Arsitektur Perencanaan dan Pengembangan Kebijakan')){
                    $faculty = 'SAPPK';
                }
                else if($faculty == ('Sekolah Bisnis dan Manajemen')){
                    $faculty = 'SBM';
                }
                else if($faculty == ('Sekolah Bisnis')){
                    $faculty = 'SB';
                }
                else if($faculty == ('Sekolah Farmasi')){
                    $faculty = 'SF';
                }
                else if($faculty == ('Sekolah Ilmu dan Teknologi Hayati')){
                    $faculty = 'SITH';
                }
                else if($faculty == ('Sekolah Teknik Elektro dan Informatika')){
                    $faculty = 'STEI';
                }
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
<a href="'.route('verify.updateReject', $model->id).'" class="btn btn-danger btn-sm reject" name="'.$model->no_form.'">Reject</a>';
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
