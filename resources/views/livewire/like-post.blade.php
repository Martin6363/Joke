<div>
    <button wire:click="toggleLike" class="unlike-btn"><i class="{{ Auth::user()->hasLiked($post) ? 'fa-solid' : 'fa-regular' }} fa-thumbs-up"></i></button>
    <span class="lead" style="font-size: 18px"><small>{{ $post->likes->count() }}</small></span>
</div>