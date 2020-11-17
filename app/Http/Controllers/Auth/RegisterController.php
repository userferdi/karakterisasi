<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\University;
use App\Faculty;
use App\study_program;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'no_id' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function createForm($user)
    {
        if($user=='dosenunpad'){
            $faculty = Faculty::get();
            return view('auth.register.dosenunpad',['faculty'=>$faculty]);
        }
        else if($user=='dosennonunpad'){
            return view('auth.register.dosen');
        }
        else if($user=='mahasiswaunpad'){
            $faculty = Faculty::get();
            return view('auth.register.mahasiswaunpad',['faculty'=>$faculty]);
        }
        else if($user=='mahasiswanonunpad'){
            return view('auth.register.mahasiswa');
        }
        else if($user=='userumum'){
            return view('auth.register.userumum');
        }
        else if($user=='admin'){
            return view('auth.register.admin');
        }
        else{
            abort(404);
        }
    }

    public function storeForm(Request $data)
    {
        if($data['user']=='admin'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255']
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('Admin');
            return redirect()->route('home');
        }
        else if($data['user']=='dosenunpad'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255'],
                'no_id' => ['required', 'digits_between:8,24'],
                'no_hp' => ['required', 'digits_between:8,16'],
                'faculty' => ['required', 'string', 'max:255'],
                'study_program' => ['required', 'string', 'max:255']
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('Dosen Unpad');
            if($data->file('image')!=null){
                $directory = '/upload/users/'.$id.'/';
                $filename = $data->name.'.'.$data->image->getClientOriginalExtension();
                $image = $directory.$filename;
                $data->image->move(public_path($directory), $filename);
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'image' => $image,
                    'university' => 'Universitas Padjadjaran',
                    'faculty' => Faculty::find($data->faculty)->name,
                    'study_program' => study_program::find($data->study_program)->name
                ]);
            }
            else{
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'university' => 'Universitas Padjadjaran',
                    'faculty' => Faculty::find($data->faculty)->name,
                    'study_program' => study_program::find($data->study_program)->name
                ]);
            }
            return redirect()->route('home');
        }
        else if($data['user']=='dosennonunpad'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255'],
                'no_id' => ['required', 'digits_between:8,24'],
                'no_hp' => ['required', 'digits_between:8,16'],
                'university' => ['required', 'string', 'max:255'],
                'faculty' => ['required', 'string', 'max:255'],
                'study_program' => ['required', 'string', 'max:255']
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('Dosen Non Unpad');
            if($data->file('image')!=null){
                $directory = '/upload/users/'.$id.'/';
                $filename = $data->name.'.'.$data->image->getClientOriginalExtension();
                $image = $directory.$filename;
                $data->image->move(public_path($directory), $filename);
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'image' => $image,
                    'university' => $data->university,
                    'faculty' => $data->faculty,
                    'study_program' => $data->study_program
                ]);
            }
            else{
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'university' => $data->university,
                    'faculty' => $data->faculty,
                    'study_program' => $data->study_program
                ]);
            }
            return redirect()->route('home');
        }
        else if($data['user']=='mahasiswaunpad'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255'],
                'no_id' => ['required', 'digits_between:8,24'],
                'no_hp' => ['required', 'digits_between:8,16'],
                'faculty' => ['required', 'string', 'max:255'],
                'study_program' => ['required', 'string', 'max:255'],
                'email_lecturer' => ['required', 'string', 'email', 'max:255']
            ]);
            $lecturer = User::where('email',$data->email_lecturer)->first();
            if($lecturer==NULL){
                return redirect()->back()->withInput($data->input())->withErrors(['email_lecturer', 'Lecturer has not registered yet']);
            }
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('Mahasiswa Unpad');
            if($data->file('image')!=null){
                $directory = '/upload/users/'.$id.'/';
                $filename = $data->name.'.'.$data->image->getClientOriginalExtension();
                $image = $directory.$filename;
                $data->image->move(public_path($directory), $filename);
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'image' => $image,
                    'university' => 'Universitas Padjadjaran',
                    'faculty' => Faculty::find($data->faculty)->name,
                    'study_program' => study_program::find($data->study_program)->name,
                    'email_lecturer' => $data->email_lecturer
                ]);
            }
            else{
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'university' => 'Universitas Padjadjaran',
                    'faculty' => Faculty::find($data->faculty)->name,
                    'study_program' => study_program::find($data->study_program)->name,
                    'email_lecturer' => $data->email_lecturer
                ]);
            }
            return redirect()->route('home');
        }
        else if($data['user']=='mahasiswanonunpad'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255'],
                'no_id' => ['required', 'digits_between:8,24'],
                'no_hp' => ['required', 'digits_between:8,16'],
                'university' => ['required', 'string', 'max:255'],
                'faculty' => ['required', 'string', 'max:255'],
                'study_program' => ['required', 'string', 'max:255'],
                'email_lecturer' => ['required', 'string', 'email', 'max:255']
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('Mahasiswa Non Unpad');
            if($data->file('image')!=null){
                $directory = '/upload/users/'.$id.'/';
                $filename = $data->name.'.'.$data->image->getClientOriginalExtension();
                $image = $directory.$filename;
                $data->image->move(public_path($directory), $filename);
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'image' => $image,
                    'university' => $data->university,
                    'faculty' => $data->faculty,
                    'study_program' => $data->study_program,
                    'email_lecturer' => $data->email_lecturer
                ]);
            }
            else{
                $profile = Profile::create([
                    'user_id' => $id,
                    'no_id' => $data->no_id,
                    'no_hp' => $data->no_hp,
                    'university' => $data->university,
                    'faculty' => $data->faculty,
                    'study_program' => $data->study_program,
                    'email_lecturer' => $data->email_lecturer
                ]);
            }
            return redirect()->route('home');
        }
        else if($data['user']=='userumum'){
            $data->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'name' => ['required', 'string', 'max:255'],
                'no_id' => ['required', 'digits_between:8,24'],
                'no_hp' => ['required', 'digits_between:8,16'],
                'institution' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255']
            ]);
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            $user->sendEmailVerificationNotification();
            auth()->user()->assignRole('User Umum');
            $profile = Profile::create([
                'user_id' => $id,
                'no_id' => $data->no_id,
                'no_hp' => $data->no_hp,
                'institution' => $data->institution,
                'address' => $data->address
            ]);
            return redirect()->route('home');
        }
        else{
            abort(404);
        }
    }

    public function dataFaculty()
    {
        $model = Faculty::get();
        return json_encode($model);
    }

    public function dataStudyProgram($id)
    {
        $model = study_program::where('faculties_id', $id)->get();
        $output = '';
        foreach($model as $row){
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
        return json_encode($model);
    }
}
