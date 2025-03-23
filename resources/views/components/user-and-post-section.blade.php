<section class="mb-3">
    <div class="card {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-light text-gray-700'}}">
        <div class="card-header d-flex justify-between">
            <div class="user_post_data_block">
                <a href="{{ route('profile.view', [$user->id]) }}" wire:navigate class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}">
                    <img src="{{ Storage::url('avatar/' . $user->avatar) }}" class="card-img-top user_logo_post" alt="">
                </a>
                <div class="d-flex post_user_data_box">
                    <a href="{{ route('profile.view', [$user->id]) }}" wire:navigate class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}" style="text-decoration: underline;"><strong>{{ $user->name }}</strong></a>
                    <small style="color: #949494"><b>{{ $post->created_at->diffForHumans() }}</b></small>
                </div>
            </div>
            <div class="setting_post">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <span class="active:bg-gray-400 p-1" style="cursor: pointer; border-radius: 100px;"><i class="fa-solid fa-ellipsis"></i></span>
                    </x-slot>
                    <x-slot name="content" class=" {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-light text-gray-900'}}">
                        @if (Auth::user()->id === $post->user_id)
                            <a wire:navigate class="flex justify-between w-full {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out"
                                href="{{route('post.edit', $post->id)}}">
                                Edit <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" class="w-full flex justify-between {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $post->id }}">
                                Delete <i class="fa-solid fa-trash"></i>
                            </button>
                        @else
                            <span class="m-2 text-muted">No Info</span>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>{{ $post->title }}</b></h5>
            @if ($post->image && Storage::exists('public/post-images/' . $post->image))
                <div class="post_image_box">
                    <img class="post_image" src="{{ Storage::url('post-images/'.$post->image) }}" alt="Post Image">
                </div>
            @endif
            <p class="card-text">
                @php
                    $descriptionWithLinks = preg_replace(
                        '/\b(https?:\/\/\S+?\.\S+?)(?=\s|$|\p{P})/u',
                        '<a href="$1" target="_blank">$1</a>',
                        $post->description
                    );
                @endphp
                {!! $descriptionWithLinks !!}
            </p>
        </div>
        <div class="card-footer">
            <div class="card_footer_container d-flex justify-between" style="font-size: 20px">
                <div class="share_comment_cont w-full">
                    <div class="flex items-center w-full justify-between gap-1 float-end">
                        <livewire:like-post :key="'likes' . $post->id" :post="$post" />
                        <div class="flex items-center">
                            <button class="btn {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}" type="button" data-bs-toggle="collapse" tabindex="{{ $post->id }}" data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false" aria-controls="collapseExample{{ $post->id }}">
                                <i class="fa-regular fa-comment"></i> Comments
                            </button>
                            <i class="fa-solid fa-share"></i> <small>Share</small>
                        </div>
                    </div>
                    <livewire:post-comments :key="'comments-' . $post->id" :post="$post"/> 
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-800' }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                        <button type="button" style="width: 40px; height: 40px;" class="btn-close {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800' }}" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="text-gray-600">
                            Are you sure you want to delete the post? <br>
                            <small class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-900' }}">
                                {{ $post->title }}
                            </small>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-900' }}" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-id="{{ $post->id }}" class="btn btn-danger bg-danger" id="confirmDelete-{{ $post->id }}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <script>
    $(document).ready(function() {
        $("#confirmDelete-{{ $post->id }}").click(function() {
            var id = $(this).data("id");
            var url = '{{ route(post.delete) }}'
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '',
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    this.parent($('.card')).remove();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}