<div class="card mb-4">
    <div class="card-header">Avatar profile</div>
    <div class="card-body">
        <div class="text-center">
            <!-- Profile picture image-->
            <img class="img-account-profile rounded-circle img-thumbnail mb-2"
                src="{{ auth()->user()->avatar == null? asset('/images/avatar.png'): asset('/storage/images/' . Auth::user()->avatar) }}" alt="profile_image"
                style="width: 250px; height: 250px; object-fit: cover;"><br>
            <!-- Profile picture upload button-->
            @include('user.uploading')
        </div>
    </div>
</div>
