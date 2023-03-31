<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUsers()
    {
        return Inertia::render('Users',[
            'departments' => Department::All(),
            'users' => User::select('users.id as users_id','users.name as users_name','kana','department_id','departments.name as department_name','employment_date',)
                        ->leftJoin('departments', 'department_id','=', 'departments.id')
                        ->where('users.id','<>','9999')
                        ->orderBy('users_id','asc')
                        ->get()
        ]);
    }

    public function userStore(Request $request){
        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'kana' => $request->kana,
            'department_id' => $request->department_id,
            'employment_date' => $request->employment_date,
            'password' => Hash::make($request->password),
        ]);
    }
}
