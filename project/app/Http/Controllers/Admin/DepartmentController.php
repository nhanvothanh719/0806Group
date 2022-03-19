<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DepartmentController extends Controller
{
    public function indexDepartment()
    {
    
        $itemDepartment = Department::all();
        return view('admin.department.indexDepartment');
        
    }

    public function getDtRowData(Request $request)
    {
        $department = Department::all();

        return Datatables::of($department)
            ->editColumn('name', function ($data) {
                return ' <a href="' . route('admin.missions.department.index', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('mission', function ($data) {
                return $data->missions->count();
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="'.route("admin.department.update",$data->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                
                <form method="POST" action="' . route('admin.department.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this department ?\')"><i class="fa-solid fa-trash"></i></button>
                </form>
                ';
                
            })
            ->rawColumns(['action','name'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }

    public function delete($id)
    {
        $data = Department::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('flash_message', 'User deleted!');
    }

    public function create(Request $request){
        //todo: Add create category request
        $name = $request->name;
        Department::create([
            'name' => $name,            
        ]);
        //send mail
        return redirect()->back()->with('flash_message', 'User created!');
    }
    public function edit($id){
        $itemDepartment = Department::findOrFail($id);
        return view('admin.department.editDepartment',compact('itemDepartment'));
    }
    public function update(Request $request, $id){
        $dataDpm = Department::findOrFail($id);
        // assign information to data variable
        $data = $request -> all();
        $dataDpm->update($data);
        $dataDpm->save();
        return redirect('admin/department');
    }
}
