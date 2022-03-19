<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\Account;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $department = DB::table('departments')->count();
        $category = DB::table('categories')->count();
        $account = DB::table('users')->count();
        $mission = DB::table('missions')->count();
        return view('admin.dashboard', compact('department','category','account','mission'));
    }

    
}
