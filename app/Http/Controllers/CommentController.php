<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;
use App\Models\User;
use App\Models\Comment;
use App\Models\Mission;
use App\Http\Requests\CommentStoreRequest;
use Symfony\Contracts\EventDispatcher\Event;
use App\Events\ClickButton;
use App\Events\CommentEvent;
use App\Jobs\SendEmailNewComment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addComment(CommentStoreRequest $request, $id)
    {
        $input = $request->all();
        $user = Auth::user();
        $idea = Idea::findOrFail($id);
        $comment = new Comment();
        $comment->content = $input['content'];
        $comment->user_id = $user->id;
        $comment->idea_id = $idea->id;
        //idea() from Comment model
        $comment->idea()->associate($idea);
        $comment->user()->associate($user);
        $comment->save();
        SendEmailNewComment::dispatch($comment, $user, $idea)->delay(now());
        return redirect()->back()->with(['class' => 'success', 'message' => 'Comment inserted successfully']);;
    }

    public function changeComment($id)
    {
        $comment = Comment::findOrFail($id);
        return view('', compact('comment'));
    }

    public function editComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $request->content
        ]);

        return redirect()->back()->with(['class' => 'success', 'message' => 'Comment modified successfully']);
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with(['class' => 'success', 'message' => 'Comment removed successfully']);
    }
}
