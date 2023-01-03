<div>
    <span class="{{ $isLikeByUser ? 'text-primary' : '' }}" wire:click="like"><i class="far fa-thumbs-up cursor-pointer"
            ></i><span class="ms-1">{{ $LikeCount }}</span></span>
    <span class="{{ $isDislikeByUser ? 'text-primary' : '' }}" wire:click="dislike"><i class="far fa-thumbs-down cursor-pointer ms-3"
           ></i><span class="ms-1">{{ $DislikeCount }}</span></span>
</div>