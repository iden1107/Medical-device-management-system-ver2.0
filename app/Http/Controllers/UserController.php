<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUsers()
    {
        return Inertia::render('Users',[
            'departments' => Department::All(),
            'users' => DB::table('users')
                        ->select('users.id as users_id','users.name as users_name','kana','department_id','employment_date',)
                        ->leftJoin('departments','users.id','=', 'departments.id')
                        ->where('users.id','<>','9999')
                        ->get()
        ]);
    }
}
