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
        return view('settings', ['model' => Auth()->User()]);
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
        return view('editprofile', ['model' => Auth()->User()]);
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

    public function datatable()
    {
        $users = User::get();
        $client = $users->reject(function ($user) {
            return $user->hasRole('Admin');
        });
    }
}
