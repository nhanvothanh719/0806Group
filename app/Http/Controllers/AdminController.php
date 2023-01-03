<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\Account;
use App\Models\Mission;
use DB;


class AdminController extends Controller
{
    public function index()
    {
        $department = DB::table('departments')->count();
        $semester = DB::table('semesters')->count();
        $account = DB::table('users')->count();
        $mission = DB::table('missions')->count();
        return view('admin.dashboard', compact('department','semester','account','mission'));
    }

    
}
