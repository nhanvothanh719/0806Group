<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaStoreRequest;
use App\Http\Requests\IdeaUpdateRequest;
use App\Jobs\SendEmailCreateIdea;
use App\Models\Attachment;
use App\Models\Idea;
use App\Models\Mission;
use App\Models\Comment;
use App\Models\Role;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ViewIdeaEvent;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\CliArguments\Builder as CliArgumentsBuilder;

class IdeaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $missions = Mission::where('end_at', '>=', now())->get();
        $all_missions = Mission::get();
        //Search by key
        $user_input = $request->input('search');
        //Search by mission
        $selected_mission_id = $request->mission_id;
        if ($selected_mission_id != 0) {
            $ideas = Idea::query()
                ->where('mission_id', $selected_mission_id)
                ->where(function ($query) use ($user_input) {
                    $query->where('title', 'LIKE', "%{$user_input}%")->orWhere('content', 'LIKE', "%{$user_input}%");
                });
        } else {
            $ideas = Idea::query()
                ->where('title', 'LIKE', "%{$user_input}%")
                ->orWhere('content', 'LIKE', "%{$user_input}%");
        }
        //Search by condition:
        $selected_filter = $request->filter;
        switch ($selected_filter) {
                //Search ideas with order by number of likes
            case "likes":
                $ideas = $ideas
                    ->joinReactionCounterOfType('Like')
                    ->orderBy('reaction_like_count', 'desc')
                    ->paginate(4);
                break;
            case "likes_asc":
                $ideas = $ideas
                    ->joinReactionCounterOfType('Like')
                    ->orderBy('reaction_like_count', 'asc')
                    ->paginate(4);
                break;
                //Search ideas with order by number of dislikes
            case "dislikes":
                $ideas = $ideas
                    ->joinReactionCounterOfType('Dislike')
                    ->orderBy('reaction_dislike_count', 'desc')
                    ->paginate(4);
                break;
            case "dislikes_asc":
                $ideas = $ideas
                    ->joinReactionCounterOfType('Dislike')
                    ->orderBy('reaction_dislike_count', 'asc')
                    ->paginate(4);
                break;
                //Search ideas with order by number of views
            case "views":
                $ideas = $ideas->orderBy('view_count', 'desc')->paginate(4);
                break;
            case "views_asc":
                $ideas = $ideas->orderBy('view_count', 'asc')->paginate(4);
                break;
                //Search ideas with order by comments
            case "comments":
                $ideas = $ideas->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
                break;
            case "comments_asc":
                $ideas = $ideas->withCount('comments')->orderBy('comments_count', 'asc')->paginate(4);
                break;
                //Search ideas with order by posted time
            case "recently":
                $ideas = $ideas->withCount('comments')->orderBy('created_at', 'desc')->paginate(4);
                break;
            case "recently_asc":
                $ideas = $ideas->withCount('comments')->orderBy('created_at', 'asc')->paginate(4);
                break;
            default:
                $ideas = $ideas->withCount('comments')->paginate(4);
                break;
        }
        return view(
            'ideas.index',
            compact(['missions', 'ideas', 'all_missions', 'request'])
        );
    }

    public function store(IdeaStoreRequest $request)
    {
        $mission = Mission::find($request->mission_id);
        if (!$mission) {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Mission not found']);
        }
        if (now() > $mission->end_at) {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Mission close']);
        }
        $input = $request->except('_token');
        $input['user_id'] = auth()->user()->id;
        $idea = Idea::create($input);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $custom_file_name = time() . '-' . $file->getClientOriginalName();
                $filename = $file->storeAs('public/idea/' . $idea->id, $custom_file_name);
                Attachment::create([
                    'name' => $file->getClientOriginalName(),
                    'direction' => 'storage/idea/' . $idea->id . '/' . $custom_file_name,
                    'idea_id' => $idea->id,
                ]);
            }
        }
        $Coordinator_role = Role::where('name', '=', Role::ROLE_QA_Coordinator)->first()->id;
        $users = User::where('role_id', $Coordinator_role)->get();
        SendEmailCreateIdea::dispatch($idea, $users)->delay(now());
        return redirect()->back()->with(['class' => 'success', 'message' => 'Create Idea success']);
    }

    public function details(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        $current_mission_id = Mission::findOrFail($idea->mission_id)->semester_id;
        $current_semester_end_day = Semester::findOrFail($current_mission_id)->end_day;
        $comments = Comment::where('idea_id', '=', $idea->id)->orderBy('created_at', 'desc')->paginate(5);
        //Fire event
        event(new ViewIdeaEvent($idea));
        return view('ideas.details', compact('idea', 'comments', 'current_semester_end_day'));
    }

    public function edit($id)
    {
        $idea = Idea::findOrFail($id);
        return view('ideas.edit', compact('idea'));
    }


    public function update(IdeaUpdateRequest $request, $id)
    {
        $idea = Idea::findOrFail($id);

        if ($idea->user->id != auth()->user()->id) abort(404);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $custom_file_name = time() . '-' . $file->getClientOriginalName();
                $filename = $file->storeAs('public/idea/' . $idea->id, $custom_file_name);
                Attachment::create([
                    'name' => $file->getClientOriginalName(),
                    'direction' => 'public/idea/' . $idea->id . '/' . $custom_file_name,
                    'idea_id' => $idea->id,
                ]);
            }
        }
        $idea->update([
            'content' => $request->content
        ]);
        return redirect()->back()->with(['class' => 'success', 'message' => 'Update success']);
    }

    public function delete($id)
    {
        $idea = Idea::findOrFail($id);
        //Delete all comments beloging to idea
        $comments = Comment::where('idea_id', $id);
        $comments->delete();
        //Delete all attached files beloging to idea
        //in the public folder
        $directory = 'public/idea/' . $id;
        Storage::deleteDirectory($directory);
        //in database
        $attached_files = Attachment::where('idea_id', $id);
        $attached_files->delete();
        $idea->delete();
        return redirect()->route('ideas.index')->with(['class' => 'success', 'message' => 'Your idea is deleted']);
    }

    public function deleteAttachment($id)
    {
        $attached_file = Attachment::find($id);
        $directory = $attached_file->direction;
        Storage::delete($directory);
        $attached_file->delete();
        return redirect()->back()->with(['class' => 'success', 'message' => 'File is deleted']);
    }
}
