<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="profile_wrapper mt-5 flex">
                <div class="row">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="col-md-6 col-lg-4">
                                <div class="card-box">
                                    <div class="card-header flex justify-end mb-2">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <span class="active:bg-gray-400 p-1" style="cursor: pointer; border-radius: 100px;">
                                                    <i class="fa-solid fa-ellipsis {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800'}}"></i>
                                                </span>
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
                                    <div class="card-thumbnail">
                                        <img src="{{ Storage::url('post-images/'.$post->image) }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="flex flex-col justify-start">
                                        <h3 class="mt-2">
                                            <a href="#" class="mt-2 text-danger">{{ $post->title }}</a>
                                        </h3>
                                        <span style="color: #8a8a8a">{{ $post->category->name }}</span>
                                    </div>
                                    <div class="content">
                                        <p class="text-secondary description">{{ $post->description }}</p>
                                    </div>
                                    <div class="show-more float-right">
                                        <a href="#" class="show_hide" data-content-id="{{ $loop->iteration }}">
                                            <i class="fa-solid fa-caret-down"></i> Show More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
    
                        @else
                        <div class="flex items-center justify-center my-10 min-h-100">
                            <a href="{{ route("post.create") }}">Create Post</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".content").hide();
            $(".show_hide").on("click", function (e) {
                e.preventDefault();
                var content = $(this).closest(".card-box").find(".content");
                var txt = content.is(':visible') ? '<i class="fa-solid fa-caret-down"></i> Show More' : 'Show Less <i class="fa-solid fa-caret-up"></i>';
                $(this).html(txt);
                content.slideToggle(200);
            });
        });
    </script>
</x-app-layout>
