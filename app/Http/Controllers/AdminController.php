<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function datatable()
    {
        $users = User::get();
        $client = $users->reject(function ($user) {
            return $user->hasRole('Admin');
        });
    }
}
