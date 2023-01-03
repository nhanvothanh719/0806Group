@extends('layouts.main')

@section('title')
    {{ $idea->title }}
@endsection

@section('custom-css')
    <link href="{{ asset('/css/idea.css') }}" rel="stylesheet" />
@endsection


@section('content')
    <div class="container">
        <div class="idea-block">
            <h4>Edit Idea: {{ $idea->title }}</h4>
            <form action="{{ route('ideas.update',$idea->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group @error('content') is-invalid @enderror">
                    <label for="content" class="col-form-label" rows="5">Content:</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="15" name="content">{{ $idea->content }}</textarea>
                    @if ($errors->has('content'))
                        <span>
                            @error('content')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </span>
                    @endif
                </div>
                <div class="form-group @error('choosen-file') is-invalid @enderror">
                    <label for="choosen-file" class="col-form-label">Upload more file:</label><br />
                    <input type="file" class="form-control file" name="files[]" multiple />
                    @if ($errors->has('files'))
                        <span>
                            @error('files')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <h1 class="comments-title">Attachments in idea: {{ $idea->attachments->count() }}</h1>
            @foreach ($idea->attachments as $attachment)
                <a href="{{ asset($attachment->direction) }}">{{ $attachment->name }}</a>
                @if ($idea->user->id == auth()->user()->id)
                <form method="post" action="{{route('ideas.attachment.delete', $attachment->id)}}" style="display: inline;">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn">
                        <i class=" fa fa-solid fa-trash"></i>
                    </button>
                </form>
                @endif
                <br>
            @endforeach
        </div>
    </div>
@endsection
