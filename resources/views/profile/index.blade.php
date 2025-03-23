<x-app-layout>
    <div class="py-12">
       <div class="container p-0 py-3 {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-200 text-gray-800' }}">
        <div class="col">
            <div class="col-md-4 w-full mt-2">
                <!-- User Avatar -->
                <div class="py-3 profile_view_header" style="position: relative;">
                    <video autoplay muted loop id="myVideo" class="video-background" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
                        <source src="{{ asset('assets/images/star-loop-background.mp4') }}" type="video/mp4">
                    </video>
                    <div class="mx-auto m-2 p-2 avatar-container" data-bs-toggle="modal" data-bs-target="#bigAvatar" style="width: 150px; height: 150px; border: 5px solid #b1b1b1; border-radius: 50%; position: relative; z-index: 1; cursor: pointer;">
                        <img src="{{ Storage::url('avatar/' . $authUserWithPosts->avatar) }}" class="card-img-top w-full h-full" style="border-radius: 50%;" alt="User Avatar">
                    </div>
                    <h5 class="card-title text-center my-3 font-bold" style="font-size: 25px; color: white; z-index: 1; position: relative;">
                        {{ $authUserWithPosts->name }}
                        @if (Auth::user()->id == $authUserWithPosts->id)
                            <a wire:navigate href="{{ route('profile.update') }}" class="text-gray-200 ml-3 p-2 rounded" style="background: rgb(255,255,255,0.3)"><i class="fa-solid fa-pencil"></i></a>
                        @endif
                    </h5>
                    <div class="card-body user-info" style="z-index: 1; position: relative; color: white;">
                        <div class="text-heading mx-auto">
                            <p class="user_result_text">
                                <span class="stat-number" style="font-family: Poppins, sans-serif;">{{ $authUserWithPosts->follows->count() }}</span>
                                <small class="text-lead">Followers</small>
                            </p>
                            <p class="user_result_text">
                                <span class="stat-number" style="font-family: Poppins, sans-serif;">{{ $authUserWithPosts->posts_count }}</span>
                                <small class="text-lead">Posts</small>
                            </p>
                            <p class="user_result_text">
                                <span class="stat-number" style="font-family: Poppins, sans-serif;">
                                    {{ $totalLikes }}
                                </span>
                                <small class="text-lead">Likes</small>
                            </p>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-8 mx-auto mt-3">
                <div class="create_post my-2">
                    <div class="card text-center {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-gray-100 text-gray-800'}}">
                        <div class="card-body">
                            <h5 class="card-title"><b>Create Your Post</b></h5>
                            <a wire:navigate href="{{ route('post.create') }}" class="btn w-full {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800'}}">Create <i class="fa-solid fa-pen-to-square"></i></a>
                            <a wire:navigate href="{{ route('post.index') }}" class="btn bg-transparent w-full mt-1 {{ $theme == 'dark' ? 'text-gray-300' : 'text-gray-800'}}">Unpublished Posts <i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
                <!-- User Posts -->
                <div class="row">
                    @foreach ($authUserWithPosts->posts->sortByDesc('created_at') as $item)
                        <x-user-and-post-section :user="$authUserWithPosts" :post="$item" :theme="$theme" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal markup -->
<div class="modal fade" id="bigAvatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-100 text-gray-800' }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span>{{ $authUserWithPosts->name }}</span> <small>Avatar</small></h5>
                <button type="button" class="btn-close flex items-center justify-center {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800' }}" data-bs-dismiss="modal" aria-label="Close" style="font-size: 25px">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ Storage::url('avatar/' . $authUserWithPosts->avatar) }}" class="card-img-top w-full h-full" alt="User Avatar">
            </div>
        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/counterup/1.0.0/jquery.counterup.min.js"></script>

    <script>
        // $('.stat-number').each(function () {
        //     var size = $(this).text().split(".")[1] ? $(this).text().split(".")[1].length : 0;
        //     $(this).prop('Counter', 0).animate({
        //         Counter: $(this).text()
        //     }, {
        //         duration: 5000,
        //         step: function (func) {
        //             $(this).text(parseFloat(func).toFixed(size));
        //         }
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function() {
            const childSplit = new SplitText(".user_result_text", {
                type: "lines",
                linesClass: "split-child"
            });
            
            const parentSplit = new SplitText(".user_result_text", {
                type: "lines",
                linesClass: "split-parent"
            });

            gsap.from(childSplit.lines, {
                duration: 1.5,
                yPercent: 100,
                ease: "power4",
                stagger: 0.1
            });

            $(document).find('#btn-ripple').on('click', function(e) {
                gsap.fromTo('.ripples', {
                    border: '1px solid #fff',
                    left: e.offsetX,
                    top: e.offsetY,
                    height: 0,
                    width: 0,
                    opacity: 1,
                }, {
                    border: '0px solid #fff',
                    height: 60,
                    width: 60,
                    opacity: 0,
                    duration: 1,
                    ease: "power2.out"
                })
            });
        });
    </script>
</x-app-layout>