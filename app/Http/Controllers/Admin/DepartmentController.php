<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest as UpdateDepartment;

class DepartmentController extends Controller
{
    public function indexDepartment()
    {

        $itemDepartment = Department::all();
        return view('admin.Department.indexDepartment', compact('itemDepartment'));
    }

    public function getDtRowData(Request $request)
    {
        $department = Department::all();

        return Datatables::of($department)
            ->editColumn('name', function ($data) {
                return ' <a href="' . route('admin.account.department.index', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('account', function ($data) {
                return $data->users->count();
            })
            ->rawColumns(['action', 'name'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
}
