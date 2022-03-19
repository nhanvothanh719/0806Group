<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Yajra\Datatables\Datatables;

class SemesterController extends Controller
{
    public function indexSemester()
    {
    
        $semester = Semester::all();
        return view('admin.semester.indexSemester');
    }

    public function getDtRowData(Request $request)
    {
        $semester = Semester::all();

        return Datatables::of($semester)
            ->editColumn('name', function ($data) {
                return ' <a href="' . route('admin.missions.semester.index', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('end_day', function ($data) {
                return $data->end_day;
            })
            ->editColumn('mission', function ($data) {
                return $data->missions->count();
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="'.route("admin.semester.update",$data->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                <form method="POST" action="' . route('admin.semester.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
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
        $data = Semester::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('flash_message', 'Semester deleted!');
    }

    public function create(Request $request){
        //todo: Add create semester request
        $name = $request->name;
        $end_day = $request->end_day;
        Semester::create([
            'name' => $name,
            'end_day' => $end_day            
        ]);
        //send mail
        return redirect()->back()->with('flash_message', 'Semester created!');
    }
    public function edit($id){
        $itemSemester = Semester::findOrFail($id);
        return view('admin.semester.editSemester',compact('itemSemester'));
    }
    public function update(Request $request, $id){
        $dataSmt = Semester::findOrFail($id);
        // assign information to data variable
        $data = $request -> all();
        $dataSmt->update($data);
        $dataSmt->save();
        return redirect('admin/semester');
    }
}
