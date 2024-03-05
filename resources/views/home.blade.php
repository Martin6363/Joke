<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 mt-10" style="width: 60%">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex justify-between">
                <nav class="bg-gray-100 dark:bg-gray-100 main_left_nav" id="dashboard_left_nav">
                    <div class="create_post">
                        <div class="card text-center bg-slate-300">
                            <div class="card-header">
                              {{ Auth::user()->name }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><b>Create Your Post</b></h5>
                                <a href="{{ route('post.create') }}" class="btn bg-slate-400 w-full">Create <i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('post.index') }}" class="btn bg-transparent w-full mt-1">View Posts <i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="category_box mt-2">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item" style="border-radius: 5px">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Category
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse visible collapse" style="border-radius: 5px" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                @foreach ($categories as $category)
                                    <a href="{{ route('post.create') }}" class="accordion-body btn w-full text-left hover:bg-gray-400 p-2">{{ $category->name }}</a>
                                @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="p-6 text-gray-900 dark:text-gray-100 content-middle">
                    @foreach ($usersWithPosts as $key => $user)
                        @foreach ($user->posts as $post)
                            @if ($post->user_id >= 1)
                                <section class="mb-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-between">
                                            <div class="user_post_data_block">
                                                <a href="">
                                                    <img src="{{ Storage::url('avatar/' . $user->avatar) }}" class="card-img-top user_logo_post" alt="">
                                                </a>
                                                <div class="d-flex post_user_data_box">
                                                    <strong>{{ $user->name }}</strong>
                                                    <small style="color: #949494"><b>3s</b></small>
                                                </div>
                                            </div>
                                            <div class="setting_post">
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <span class="active:bg-gray-400 p-1" style="cursor: pointer; border-radius: 100px;"><i class="fa-solid fa-ellipsis"></i></span>
                                                    </x-slot>
                                                    <x-slot name="content" class="bg-dark">
                                                        @if (Auth::user()->id === $post->user_id)
                                                            <x-dropdown-link class="flex justify-between" :href="route('post.edit', $post->id)">
                                                                Edit <i class="fa-solid fa-pen"></i>
                                                            </x-dropdown-link>
                                                            <x-dropdown-link class="flex justify-between">
                                                                Delete <i class="fa-solid fa-trash"></i>
                                                            </x-dropdown-link>
                                                        @else
                                                            <span class="m-2 text-muted">No Info</span>
                                                        @endif
                                                    </x-slot>
                                                </x-dropdown>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{ $post->title }}</b></h5>
                                            <p class="card-text">{{ $post->description }}</p>
                                            <div class="post_image_box">
                                                @if ($post->image)
                                                    <img src="{{ Storage::url('post-images/'.$post->image) }}" alt="Post Image">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="card_footer_container d-flex justify-between" style="font-size: 20px">
                                                <div class="post_favorite_box d-flex items-center gap-2" style="height: 40px">
                                                    <i class="fa-regular fa-thumbs-up"></i>
                                                    <span class="lead" style="font-size: 18px">3k</span>
                                                </div>
                                                <div class="share_comment_cont">
                                                    <div class="d-flex items-center float-end">
                                                        <i class="fa-solid fa-share"></i>
                                                        <button class="btn" type="button" data-bs-toggle="collapse" tabindex="{{ $post->id }}" data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false" aria-controls="collapseExample{{ $post->id }}">
                                                            <i class="fa-regular fa-comment"></i>
                                                        </button>
                                                    </div>
                                                    <div class="collapse visible mt-10" style="width: 100% !important;" id="collapseExample{{ $post->id }}">
                                                        <div class="card card-body w-full">
                                                            <div class="comments_user">
                                                                <!-- Comments content here -->
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis distinctio praesentium voluptates porro, nostrum pariatur facilis unde id, excepturi assumenda tenetur, inventore consectetur aspernatur dolor rerum facere ipsam deleniti quaerat.
                                                                Temporibus iure totam distinctio blanditiis, repellat reprehenderit aut nostrum voluptatem soluta eius ipsa suscipit odit quod! Quibusdam, exercitationem perferendis soluta itaque quia corrupti fugit eveniet praesentium pariatur rerum accusamus numquam?
                                                                Mollitia vel suscipit dignissimos voluptatum sapiente voluptatem quasi impedit dolore delectus vero distinctio aperiam unde necessitatibus doloribus deserunt iure maiores eaque, reprehenderit amet. Blanditiis facere doloribus laboriosam, officiis temporibus quae?
                                                            </div>
                                                            <div class="input-group mt-3 d-flex items-center gap-2">
                                                                <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
                                                                <button class="input-group-text bg-teal-400" style="padding: 10px; border-radius: 100px" id="basic-addon1">
                                                                    <i class="fa-regular fa-paper-plane"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <aside class="bg-gray-100 dark:bg-gray-100 main_right_aside" id="aside">
                    ASIDE CONTENT
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
