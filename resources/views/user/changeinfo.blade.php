<button class="btn btn-info d-inline float-md-end" data-toggle="modal" data-target="#changeInfoModal">Edit my profile</button>
<div class="modal fade" id="changeInfoModal" tabindex="-1" role="dialog" aria-labelledby="changeInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeInfoModalLabel">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.phone.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="new-phone-number" class="col-form-label">Phone number:</label>
                        <input type="tel" class="form-control @error('new-phone-number') is-invalid @enderror" id="new-phone-number" name="new-phone-number">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>