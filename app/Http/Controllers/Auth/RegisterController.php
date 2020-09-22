<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'no_id' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
            // 'institution' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
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
            return view('auth.register.dosenunpad');
        }
        else if($user=='dosennonunpad'){
            return view('auth.register.dosen');
        }
        else if($user=='mahasiswaunpad'){
            return view('auth.register.mahasiswaunpad');
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
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            Auth::login($user);
            auth()->user()->assignRole('Admin');
            return redirect()->route('home');
        }
        else if($data['user']=='dosenunpad'){
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            auth()->user()->assignRole('Dosen Unpad');
            $profile = Profile::create([
                'user_id' => $id,
                'no_id' => $data->no_id,
                'no_hp' => $data->no_hp,
                'university' => $data->university,
                'faculty' => $data->faculty,
                'study_program' => $data->study_program,
            ]);
            return redirect()->route('home');
        }
        else if($data['user']=='dosennonunpad'){
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            auth()->user()->assignRole('Dosen Non Unpad');
            $profile = Profile::create([
                'user_id' => $id,
                'no_id' => $data->no_id,
                'no_hp' => $data->no_hp,
                'university' => $data->university,
                'faculty' => $data->faculty,
                'study_program' => $data->study_program,
            ]);
            return redirect()->route('home');
        }
        else if($data['user']=='mahasiswaunpad'){
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            auth()->user()->assignRole('Mahasiswa Unpad');
            $profile = Profile::create([
                'user_id' => $id,
                'no_id' => $data->no_id,
                'no_hp' => $data->no_hp,
                'university' => $data->university,
                'faculty' => $data->faculty,
                'study_program' => $data->study_program,
                'email_lecturer' => $data->email_lecturer
            ]);
            return redirect()->route('home');
        }
        else if($data['user']=='mahasiswanonunpad'){
            $user = User::insertGetId([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
            auth()->user()->assignRole('Mahasiswa Non Unpad');
            $profile = Profile::create([
                'user_id' => $id,
                'no_id' => $data->no_id,
                'no_hp' => $data->no_hp,
                'university' => $data->university,
                'faculty' => $data->faculty,
                'study_program' => $data->study_program,
                'email_lecturer' => $data->email_lecturer
            ]);
            return redirect()->route('home');
        }
        else if($data['user']=='userumum'){
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            Auth::login($user);
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
}
