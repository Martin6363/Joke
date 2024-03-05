<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-5 mb-4 pb-2 text-yellow-50" style="border-bottom: 2px solid #818181">My Posts</h2>
                </div>
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-4">
                            <div class="card-box">
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
