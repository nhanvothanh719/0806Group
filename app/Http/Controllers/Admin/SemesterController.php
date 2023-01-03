<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Yajra\Datatables\Datatables;
use App\Http\Requests\SemesterRequest;
use App\Http\Requests\UpdateSemesterRequest as UpdateSemester;

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
                if (auth()->user()->hasRole('admin')) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="'.route("admin.semester.update",$data->id).'"><i class="fa-solid fa-pen-to-square" title="Edit Semester"></i></a>
                <form method="POST" action="' . route('admin.semester.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('DELETE') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this department ?\')"><i class="fa-solid fa-trash" title="Delete Semester"></i></button>
                </form>
                ';
                }
                return '';
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
        if($data->missions->count() != 0)
            return redirect()->back()->with('success', 'Semester cannot delete because it belong to an Misison!');
        $data->delete();
        return redirect()->back()->with('success', 'Semester deleted!');
    }

    public function create(SemesterRequest $request){
        //todo: Add create semester request
        Semester::create($request->all());
        //send mail
        return redirect()->back()->with('success', 'Create semester Successfully!');
    }
    public function edit($id){
        $itemSemester = Semester::findOrFail($id);
        return view('admin.semester.editSemester',compact('itemSemester'));
    }
    public function update(UpdateSemester $request, $id){
        $dataSmt = Semester::findOrFail($id);
        // assign information to data variable
        $data = $request -> all();
        $dataSmt->update($data);
        $dataSmt->save();
        return redirect('admin/semester') -> with('success', 'Semester successfully updated');
    }
}
