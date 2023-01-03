<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Idea;
use App\Models\Comment;

class ComentController extends Controller
{
    public function listCommentByIdea($id)
    {
        $ideas = Idea::find($id);
        if (!$ideas) abort(404); //check ideas exits
        return view(
            'admin.comments.indexbyIdea',
            [
                'ideas' => $ideas
            ]
        );
    }

    public function getDtRowDataByIdea($id, Request $request)
    {
        $ideas = Comment::where('idea_id', $id)->get();
        return Datatables::of($ideas)
            ->editColumn('content', function ($data) {
                return $data->content;
            })
            ->editColumn('user', function ($data) {
                return $data->user->name;
            })
            ->editColumn('idea', function ($data) {
                return $data->idea->title;
            })
            ->make(true);
    }
}
