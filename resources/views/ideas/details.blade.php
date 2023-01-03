@extends('layouts.main')

@section('title')
{{ $idea->title }}
@endsection

@section('custom-css')
<link href="{{ asset('/css/idea.css') }}" rel="stylesheet" />
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection

@section('content')
<div class="container">
    <div class="idea-block">
        <h4>{{ $idea->title }}
            @if ($idea->user->id == auth()->user()->id)
            <a class="float-end ms-2 btn"  href="{{ route('ideas.edit', $idea->id) }}"><i class=" fa fa-solid fa-pen-to-square"></i></a>
            <form method="post" class="float-end" action="{{route('ideas.delete', $idea->id)}}" style="display: inline;">
                @method('delete')
                @csrf
                <button type="submit" class="btn">
                    <i class=" fa fa-solid fa-trash"></i>
                </button>
            </form>
            @endif
        </h4>
        <p>{{ $idea->content }}</p>
        <h1 class="comments-title">Attachments ({{ $idea->attachments->count() }})</h1>
        @foreach ($idea->attachments as $attachment)
        <a href="{{ asset($attachment->direction) }}">{{ $attachment->name }}</a>
        <br>
        @endforeach

        @livewire('react-component', [
        'model' => $idea
        ])
        <hr>
        <h1 class="comments-title">Comments</h1>
        <div class="be-comment mb-4">
            @if(now() < $current_semester_end_day)
            <form action="{{ url('/ideas/add-comment/' . $idea->id) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control rounded-corner" name="content" placeholder="Write a comment...">
                    <span class="input-group-btn p-l-10">
                        <button class="btn btn-primary f-s-12 rounded-corner pull-right" type="submit">Submit</button>
                    </span>
                </div>
            </form>
            @else
            <form action="{{ url('/ideas/add-comment/' . $idea->id) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control rounded-corner" name="content" placeholder="Comment is unvailable" disabled>
                    <span class="input-group-btn p-l-10">
                        <button class="btn btn-primary f-s-12 rounded-corner pull-right" type="button">Submit</button>
                    </span>
                </div>
            </form>
            @endif
        </div>
        @foreach ($comments as $comment)
        <div class="comment-block">
            <div class="be-img-comment">
                <img src="{{ auth()->user()->avatar == null? asset('/images/avatar.png'): asset('/storage/images/' . Auth::user()->avatar) }}" alt="" class="be-ava-comment">
            </div>
            <div class="be-comment-content">
                <span class="be-comment-name">
                    <strong>{{ auth()->user()->hasRole('staff')? 'Anonymous': $comment->user->name }}</strong>
                </span>
                <span class="be-comment-time">
                    {{ $comment->created_at->diffForHumans() }}
                    @if($comment->user_id === auth()->user()->id)
                    @include('ideas.edit_comment')
                    <form method="post" action="{{route('comments.delete', $comment->id)}}" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button type="submit" style="border: none; padding: 0; background: none;">
                            <i class=" fa fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @else
                    <i class=" fa fa-solid fa-pen-to-square"></i>
                    <i class=" fa fa-solid fa-trash"></i>
                    @endif

                </span>

                <p class="be-comment-text">
                    {{ $comment->content }}
                </p>
            </div>
        </div>
        @endforeach
        {{ $comments->links() }}

    </div>
</div>
@endsection

@section('custom-js')
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

@endsection

