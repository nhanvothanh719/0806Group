<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\IdeaStoreRequest;
use App\Models\Attachment;
use App\Models\Idea;
use App\Models\Mission;
use App\Models\Comment;
use Illuminate\Http\Request;

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
        $ideas = Idea::withCount('comments')->paginate(5);
        return view(
            'ideas.index',
            compact(['missions', 'ideas'])
        );
    }

    public function store(IdeaStoreRequest $request)
    {
        $mission = Mission::find($request->mission_id);
        if(!$mission){
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Mission not found']);
        }
        if(now() > $mission->end_at){
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Mission close']);
        }
        $input = $request->except('_token');
        $input['user_id'] = auth()->user()->id;
        $idea = Idea::create($input);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $custom_file_name = time() . '-' . $file->getClientOriginalName();
                $filename = $file->storeAs('idea/' . $idea->id, $custom_file_name);
                Attachment::create([
                    'name' => $file->getClientOriginalName(),
                    'direction' => $filename,
                    'idea_id' => $idea->id,
                ]);
            }
        }
        return redirect()->back()->with(['class' => 'success', 'message' => 'Create Idea success']);
    }

    public function changeIdea($id)
    {
        //find id to update
        $idea = Idea::findOrFail($id);
        return view('', compact('idea'));
    }

    public function updateIdea(IdeaStoreRequest $request, $id)
    {
        $dataCategory = Idea::findOrFail($id);
        $data = $request->all();
        $dataCategory->update($data);
        return redirect('');
    }

    public function deleteIdea($id)
    {
        $data = Idea::findOrFail($id);
        $data->delete();
        return redirect('')->with('flash_message', 'Category deleted!');
    }

    public function details(Request $request, $id)
    {
        $user_id = Auth::user() -> id;
        $idea = Idea::findOrFail($id);
        $comments = Comment::where('idea_id', '=', $idea->id)->orderBy('created_at','desc')->paginate(5);
        $attachment = Attachment::where('idea_id', '=', $idea->id)->get();
        return view('ideas.details', compact('idea', 'comments', 'attachment', 'user_id'));
    }
}
