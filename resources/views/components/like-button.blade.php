<div class="post_favorite_box d-flex items-center gap-2" style="height: 40px">
    @if (Auth::user()->likesPost($post))
        <button wire:click="unlikePost({{ $post->id }})" class="unlike-btn"><i class="fa-solid fa-thumbs-up"></i></button>
    @else
        <button wire:click="likePost({{ $post->id }})" class="like-btn"><i class="fa-regular fa-thumbs-up"></i></button>
    @endif
    <span class="lead" style="font-size: 18px"><small>{{ $post->likes->count() }}</small></span>
</div>

<script>
      document.addEventListener('livewire:load', function () {
        Livewire.on('updateLikesCount', (likesCount) => {
            $('#likes_count').html(likesCount);
        });
    });
</script>