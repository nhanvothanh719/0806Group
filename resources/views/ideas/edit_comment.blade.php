<a href=""  data-toggle="modal" data-target="#editComment"><i class=" fa fa-solid fa-pen-to-square"></i></a>
<div class="modal fade" id="editComment" tabindex="-1" role="dialog" aria-labelledby="editCommentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentLabel">Edit comment</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comments.edit', $comment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="comment-content" class="col-form-label">Content:</label>
                        <input type="text" class="form-control @error('content') is-invalid @enderror" id="comment-content" name="content" value="{{$comment->content}}">
                        @if ($errors->has('title'))
                        <span>
                            @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



