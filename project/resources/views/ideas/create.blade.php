<button class="btn btn-success d-inline float-md-end" data-toggle="modal" data-target="#exampleModal">Create Idea</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if ($missions->count() == 0)
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Can not submit idea right now</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new idea</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ideas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="idea-title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="idea-title"
                                name="title">
                            @if ($errors->has('title'))
                                <span>
                                    @error('title')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </span>
                            @endif
                        </div>
                        <div class="form-group @error('content') is-invalid @enderror">
                            <label for="content" class="col-form-label" rows="5">Content:</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"></textarea>
                            @if ($errors->has('content'))
                                <span>
                                    @error('content')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </span>
                            @endif
                        </div>
                        <div class="form-group @error('mission_id') is-invalid @enderror">
                            <label for="mission_id">Mission:</label> <br />
                            <select name="mission_id" class="form-control" id="mission_id">
                                @foreach ($missions as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }} - {{ $m->end_at->diffForHumans() }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('mission_id'))
                                <span>
                                    @error('mission_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </span>
                            @endif
                        </div>
                        <div class="form-group @error('choosen-file') is-invalid @enderror">
                            <label for="choosen-file" class="col-form-label">Choose file:</label><br />
                            <input type="file" class="form-control file" name="files[]" multiple />
                            @if ($errors->has('files'))
                                <span>
                                    @error('files')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </span>
                            @endif
                        </div><br>
                        <div class="form-check @error('form-check-input') is-invalid @enderror">
                            <input type="checkbox" name="is-agree" class="form-check-input" id="is-agree">
                            <strong class="form-check-label" for="is-agree">I agree with all 
                                <a class="link-dark text-decoration-none me-3 text-danger" href="{{ route('term') }}" target="_blank">terms and
                                    conditions</a></strong>
                        </div>
                        @if ($errors->has('is-agree'))
                            <span>
                                @error('is-agree')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </span>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    @if ($errors->has('files') || $errors->has('is-agree') || $errors->has('title') || $errors->has('content'))
        var delayInMilliseconds = 1000;
        setTimeout(function() {
        $("#exampleModal").modal('show');
        }, delayInMilliseconds);
    @endif
</script>