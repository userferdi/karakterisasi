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
    public function del($user)
    {
        $model = User::where('email',$user)->delete();
        return 'Berhasil menghapus';
    }

    public function settings()
    {
        $model = Auth()->User();
        if(Auth()->User()->hasRole('Mahasiswa Unpad|Mahasiswa Non Unpad')){
            $lecturer = User::where('email',$model->profiles->email_lecturer)->first();
            if($lecturer!=NULL){
                $model['lecturer'] = User::where('email',$model->profiles->email_lecturer)->first()->name;
            }
            else{
                $model['lecturer'] = $model->profiles->email_lecturer;
            }
        }
        return view('settings', ['model' => Auth()->User()]);
    }

    public function showAccount($id)
    {
        $model = User::find($id);
        $lecturer = User::where('email',$model->profiles->email_lecturer)->first();
        if($lecturer!=NULL){
            $model['lecturer'] = User::where('email',$model->profiles->email_lecturer)->first()->name;
        }
        else{
            $model['lecturer'] = $model->profiles->email_lecturer;
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
        $model = User::find($id);
        $profiles = Profile::where('email_lecturer',$model->email)->get();
        foreach($profiles as &$profile){
            $save = $profile->update([
                'email_lecturer' => $request->email
            ]);
        }
        $save = User::find($id)->update([
            'email' => $request->email
        ]);
        return response()->json($save);
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
            'email_lecturer' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);
        $model = Auth()->User();
        if(password_verify($request->password, $model->password)){
            $lecturer = User::where('email',$request->email_lecturer)->first();
            if($lecturer==NULL){
                $returnData = array(
                    'errors' => ['email_lecturer'=>'Lecturer has not registered yet']
                );
                return response()->json($returnData, 422);
            }
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
                $role = $model->roles()->exists();
                if($role){
                    return $model->roles[0]->name;
                }
                else{
                    $button = 
'<a href="'.route('role.Dosen',$model->id).'" class="btn btn-danger btn-sm">Insert Role Dosen</a>';
                    return $button;
                }
            })
            ->editColumn('email', function($model){
                $email = '<p>'.$model->email.'</p><a href="'.route('account.edit',$model->id).'" class="btn btn-danger btn-sm modal-show" name="Ganti Email: '.$model->name.'">Ganti Email</a>';
                return $email;
            })
            ->addColumn('show', function($model){
                $button = 
'<a href="'.route('account.show',$model->id).'" class="btn btn-danger btn-sm">Lihat</a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['role', 'email','show'])
            ->make(true);
    }

    public function roleDosen($id)
    {
        $model = User::find($id);
        $model = $model->assignRole('Dosen Unpad');
        return response()->json($model);
    }
}
