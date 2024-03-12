<section class="mb-3">
    <div class="card {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-light text-gray-700'}}">
        <div class="card-header d-flex justify-between">
            <div class="user_post_data_block">
                <a href="{{ route('profile.view', [$user->id]) }}" class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}">
                    <img src="{{ Storage::url('avatar/' . $user->avatar) }}" class="card-img-top user_logo_post" alt="">
                </a>
                <div class="d-flex post_user_data_box">
                    <a href="{{ route('profile.view', [$user->id]) }}" class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}" style="text-decoration: underline;"><strong>{{ $user->name }}</strong></a>
                    <small style="color: #949494"><b>{{ $post->created_at }}</b></small>
                </div>
            </div>
            <div class="setting_post">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <span class="active:bg-gray-400 p-1" style="cursor: pointer; border-radius: 100px;"><i class="fa-solid fa-ellipsis"></i></span>
                    </x-slot>
                    <x-slot name="content" class=" {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-light text-gray-900'}}">
                        @if (Auth::user()->id === $post->user_id)
                            <a class="flex justify-between w-full {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out"
                                href="{{route('post.edit', $post->id)}}">
                                Edit <i class="fa-solid fa-pen"></i>
                            </a>
                            <a class="flex justify-between {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out">
                                Delete <i class="fa-solid fa-trash"></i>
                            </a>
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
                <img src="{{ Storage::url('post-images/'.$post->image) }}" alt="Post Image">
            @endif
            <p class="card-text">{{ $post->description }}</p>
            <div class="post_image_box">
            </div>
        </div>
        <div class="card-footer">
            <div class="card_footer_container d-flex justify-between" style="font-size: 20px">
                <div class="share_comment_cont w-full">
                    <div class="flex items-center w-full justify-between gap-1 float-end">
                        <div class="post_favorite_box d-flex items-center gap-2" style="height: 40px">
                            <i class="fa-regular fa-thumbs-up"></i>
                            <span class="lead" style="font-size: 18px"><small>Likes</small></span>
                        </div>
                        <div>
                            <i class="fa-solid fa-share"></i> <small>Share</small>
                            <button class="btn {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}" type="button" data-bs-toggle="collapse" tabindex="{{ $post->id }}" data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false" aria-controls="collapseExample{{ $post->id }}">
                                <i class="fa-regular fa-comment"></i> Comments
                            </button>
                        </div>
                    </div>
                    <div class="collapse visible mt-10" style="width: 100%" id="collapseExample{{ $post->id }}">
                        <div class="card card-body w-full {{ $theme == 'dark' ? 'bg-gray-600 text-gray-200' : 'bg-gray-200 text-gray-900'}}">
                            <div class="comments_user">
                                <!-- Comments content here -->
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis distinctio praesentium voluptates porro, nostrum pariatur facilis unde id, excepturi assumenda tenetur, inventore consectetur aspernatur dolor rerum facere ipsam deleniti quaerat.
                                Temporibus iure totam distinctio blanditiis, repellat reprehenderit aut nostrum voluptatem soluta eius ipsa suscipit odit quod! Quibusdam, exercitationem perferendis soluta itaque quia corrupti fugit eveniet praesentium pariatur rerum accusamus numquam?
                                Mollitia vel suscipit dignissimos voluptatum sapiente voluptatem quasi impedit dolore delectus vero distinctio aperiam unde necessitatibus doloribus deserunt iure maiores eaque, reprehenderit amet. Blanditiis facere doloribus laboriosam, officiis temporibus quae?
                            </div>
                            <div class="input-group mt-3 d-flex items-center gap-2">
                                <div class="comment_content_box">
                                    <img src="{{ Storage::url('avatar/'. Auth::user()->avatar) }}" class="comment_avatar" alt="Post Image">
                                    <textarea class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" aria-label="With textarea" placeholder="Cemment"></textarea>
                                    <button class="input-group-text send_comm_btn" style="padding: 10px; border-radius: 100px" id="basic-addon1">
                                        <i class="fa-regular fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>