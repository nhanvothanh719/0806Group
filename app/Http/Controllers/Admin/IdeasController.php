<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use App\Models\Mission;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Yajra\Datatables\Datatables;

class IdeasController extends Controller
{
     public function index()
    {
        $ideas = Idea::all();
        $user = User::all();
        $missions = Mission::all();
        return view(
            'admin.ideas.index', compact(['user','ideas','missions']));
    }
    
    public function getDtRowData(Request $request){
        $ideas = Idea::all();
        // dd($ideas);
        return Datatables::of($ideas)
            ->editColumn('title', function ($data) {
                return ' <a href="' . route('admin.comments.listComment.index', $data->id) . '">' . $data->title . '</a>';
            })
            ->editColumn('content', function($data){
                return $data->content;
            })
            ->editColumn('user', function($data){
                return $data->user->name;
            })
            ->editColumn('mission', function ($data) {
                return $data->mission->name;
            })
            ->editColumn('like', function($data){
                return $data->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Like'))->getCount();
            })
            ->editColumn('dislike', function($data){
                return $data->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Dislike'))->getCount();
            })
            ->editColumn('comments', function ($data) {
                return $data->comments->count();
            })
            ->rawColumns(['title'])
            ->make(true);
    }

    // List idea by mission
     public function listIdeaByMission($id)
    {
        $missions = Mission::find($id);
        if (!$missions) abort(404); //check missions exits
        return view(
            'admin.ideas.indexbyMission',
            [
                'mission' => $missions
            ]
        );
    }
    public function getDtRowDataByMission($id, Request $request)
    {
        $missions = Idea::where('mission_id', $id)->get();
        return Datatables::of($missions)
            ->editColumn('title', function ($data) {
                return $data->title;
            })
            ->editColumn('content', function ($data) {
                return $data->content;
            })
            ->editColumn('user', function ($data) {
                return $data->user->name;
            })
            ->editColumn('mission', function ($data) {
                return $data->mission->name;
            })
            ->make(true);
    }
}
