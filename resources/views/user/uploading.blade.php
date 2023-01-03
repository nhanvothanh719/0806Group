<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#changeAvatarModal">Update avatar</button>
<div class="modal fade" id="changeAvatarModal" tabindex="-1" role="dialog" aria-labelledby="changeAvatarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeAvatarModalLabel">Upload new avatar</h5>
                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>