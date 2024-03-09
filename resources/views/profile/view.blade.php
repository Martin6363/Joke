<x-app-layout>
    <div class="py-12">
       <div class="container p-3 {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-200 text-gray-800' }}">
        <div class="col">
            <div class="col-md-4 w-full mt-2">
                <!-- User Avatar -->
                <div class="card p-2 {{ $theme == 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} text-gray-100" style="background-image: url({{asset('assets/images/profile_img.jpg')}}); background-repeat: no-repeat; background-size:cover">
                    <div class="mx-auto m-2 p-2" style="width: 150px; border: 5px solid #b1b1b1; border-radius:50%">
                        <img src="{{ Storage::url('avatar/' . $user->avatar) }}" class="card-img-top w-full h-full" alt="User Avatar">
                    </div>
                    <h5 class="card-title text-center my-3 font-bold" style="font-size: 25px">{{ $user->name }}</h5>
                    <div class="card-body">
                        <div class="text-heading mx-auto">
                            <p class="user_result_text">
                                20k
                                <small class="text-lead">Followers</small>
                            </p>
                            <p class="user_result_text">
                                {{ $user->posts_count }}
                                <small class="text-lead">Posts</small>
                            </p>
                            <p class="user_result_text">
                                200
                                <small class="text-lead">Likes</small>
                            </p>
                        </div>                          
                    </div>
                    <button class="btn btn-primary w-20 mx-auto" id="btn-ripple">Follow</button>
                </div>
            </div>
            <div class="col-md-8 mx-auto mt-3">
                @if (Auth::user()->id === $user->id)
                    <div class="create_post my-2">
                        <div class="card text-center {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-gray-100 text-gray-800'}}">
                            <div class="card-body">
                                <h5 class="card-title"><b>Create Your Post</b></h5>
                                <a href="{{ route('post.create') }}" class="btn w-full {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800'}}">Create <i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('post.index') }}" class="btn bg-transparent w-full mt-1 {{ $theme == 'dark' ? 'text-gray-300' : 'text-gray-800'}}">View Posts <i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- User Posts -->
                <div class="row">
                    @foreach ($user->posts->sortByDesc('created_at') as $post)
                        <x-user-and-post-section :user="$user" :post="$post" :theme="$theme" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const childSplit = new SplitText(".user_result_text", {
            type: "lines",
            linesClass: "split-child"
        });
        
        const parentSplit = new SplitText(".user_result_text", {
            type: "lines",
            linesClass: "split-parent"
        });

        gsap.config({trialWarn: false});
        gsap.from(childSplit.lines, {
            duration: 1.5,
            yPercent: 100,
            ease: "power4",
            stagger: 0.1
        });

        document.getElementById('btn-ripple').addEventListener('click', function(e) {
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
        })
    </script>
</x-app-layout>