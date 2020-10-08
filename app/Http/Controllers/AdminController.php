<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function settings()
    {
        $model = Auth()->User();
        if($model->profiles->email_lecturer!=NULL){
            $model['lecturer'] = User::where('email',$model->profiles->email_lecturer)->first()->name;
        }
        return view('settings', ['model' => Auth()->User()]);
    }

    public function showAccount($id)
    {
        $model = User::find($id);
        if($model->profiles->email_lecturer!=NULL){
            $model['lecturer'] = User::where('email',$model->profiles->email_lecturer)->first()->name;
        }
        return view('showProfile', ['model' => $model]);
    }

    public function editAccount($id)
    {
        $model = User::find($id);
        return view('editaccount', ['model' => $model]);
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        $model = User::find($id)->update([
            'email' => $request->email,
            'email_verified_at' => NULL
        ]);
        // return response()->json();
    }

    public function account()
    {
        return view('account');
    }

    public function edit()
    {
        $model = Auth()->User();
        $model['no_id'] = $model->profiles->no_id;
        $model['no_hp'] = $model->profiles->no_hp;
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad')){
            $model['university'] = $model->profiles->university;
            $model['faculty'] = $model->profiles->faculty;
            $model['study_program'] = $model->profiles->study_program;
        }
        return view('editprofile', ['model' => $model]);
    }

    public function editemail()
    {
        return view('editemail', ['model' => Auth()->User()]);
    }

    public function editlecturer()
    {
        return view('editlecturer', ['model' => Auth()->User()->profiles]);
    }

    public function update(Request $request)
    {
        $model = Auth()->User();
        if($model->hasRole('Dosen Unpad|Dosen Non Unpad|Mahasiswa Unpad|Mahasiswa Non Unpad')){
            $this->validate($request, [
              'name' => 'required',
              'no_id' => 'required',
              'no_hp' => ['required', 'min:10', 'max:13'],
              'university' => 'required',
              'faculty' => 'required',
              'study_program' => 'required'
            ]);
            $model = Profile::where('user_id',$model->id)->update([
                'no_id' => $request->no_id,
                'no_hp' => $request->no_hp,
                'university' => $request->university,
                'faculty' => $request->faculty,
                'study_program' => $request->study_program
            ]);
            $model = Auth()->User()->update([
                'name' => $request->name,
            ]);
        }
        else if($model->hasRole('User Umum')){
            $this->validate($request, [
                'name' => 'required',
                'no_id' => 'required',
                'no_hp' => ['required', 'min:10', 'max:13'],
                'institution' => 'required',
                'address' => 'required'
            ]);
            $model = Profile::where('user_id',$model->id)->update([
                'no_id' => $request->no_id,
                'no_hp' => $request->no_hp,
                'institution' => $request->institution,
                'address' => $request->address
            ]);
            $model = Auth()->User()->update([
                'name' => $request->name,
            ]);
        }
        else{
            abort(404);
        }
        return redirect()->route('settings');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required']
        ]);
        $model = Auth()->User();
        if(password_verify($request->password, $model->password)){
            $model = User::find($model->id)->update([
                'email' => $request->email,
                'email_verified_at' => NULL
            ]);
            return redirect()->route('settings');
        }
        else{
            $returnData = array(
                'errors' => ['password'=>'The password is wrong']
            );
            return response()->json($returnData, 422);
        }
    }

    public function updateLecturer(Request $request)
    {
        $request->validate([
            'email_lecturer' => ['required'],
            'password' => ['required'],
        ]);
        $model = Auth()->User();
        if(password_verify($request->password, $model->password)){
            $model = Profile::where('user_id',$model->id)->update([
                'email_lecturer' => $request->email_lecturer
            ]);
            return response()->json($model);
        }
        else{
            $returnData = array(
                'errors' => ['password'=>'The password is wrong']
            );
            return response()->json($returnData, 422);
        }
    }

    public function password(Request $request)
    {
        $this->validate($request, [
          'password' => 'required',
          'newpassword' => ['required','confirmed'],
          'newpassword_confirmation' => 'required',
        ]);
        $model = Auth()->User();
        if(password_verify($request->password, $model->password)){
            $model = $model->update([
                'password' => Hash::make($request->newpassword)
            ]);
            return response()->json($model);
        }
        else{
            $returnData = array(
                'errors' => ['password'=>'The password is wrong']
            );
            return response()->json($returnData, 422);
        }
    }

    public function dataAccount()
    {
        $model = User::get()->reject(function ($user) {
            return $user->hasRole('Admin');
        });
        return DataTables::of($model)
            ->addColumn('role', function($model){
                return $model->roles[0]->name;
            })
            ->addColumn('change', function($model){
                $button = 
'<a href="'.route('account.edit',$model->id).'" class="btn btn-primary modal-show" name="Ganti Email: '.$model->name.'">change email</a>';
                return $button;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('account.show',$model->id).'" class="btn btn-primary btn-sm">show</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['change', 'show'])
            ->make(true);
    }
}
