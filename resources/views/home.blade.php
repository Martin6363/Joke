<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 mt-10" style="width: 60%">
            <livewire:stories/>                    
            <div class="bg-gray-100 {{ $theme == 'dark' ? 'bg-gray-800' : 'bg-light'}} overflow-hidden shadow-sm sm:rounded-lg d-flex justify-between">
                <nav class="bg-gray-100 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-light text-gray-800'}} main_left_nav" id="dashboard_left_nav">
                    <div class="category_box mt-2">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}}" style="border-radius: 5px">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Categories
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse show visible {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}}" style="border-radius: 5px" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <a wire:navigate href="{{ asset('/home') }}" class="accordion-body btn w-full text-left flex justify-between {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }} hover:bg-gray-400 p-2">All</a>
                                @foreach ($categories as $category)
                                    <a wire:navigate href="{{ route('category.filter', ['category' => $category->name]) }}" class="accordion-body btn w-full text-left flex justify-between {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }} hover:bg-gray-400 p-2">
                                        {{ $category->name }}
                                        <small class="">{{ $category->posts_count }}</small>
                                        <input name="category_id" type="hidden" value="{{ $category->id }}">
                                    </a>
                                @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <main class="p-6 {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-900'}} content-middle">    
                    <div id="data-wrapper">
                        @foreach ($usersWithPosts as $key => $user)      
                            @foreach ($user->posts as $post)
                                @if ($post->user_id >= 1)
                                    <x-user-and-post-section :key="$key" :user="$user" :post="$post" :theme="$theme" />                        
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </main>
                <aside class="{{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-100 text-gray-800'}} bg-transparent main_right_aside" style="width: 80px" id="aside">
                    <h2 class="text-center mb-3" style="font-family: Poppins, sans-serif">Users</h2>
                    @foreach ($activeUsers as $key => $user)
                        <a href="{{ route('profile.view', [$user->id]) }}" wire:navigate class="{{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}}">
                            <div class="card {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-800'}} bg-transparent users_item_box">
                                <div class="card-body flex items-center gap-2">
                                    <img src="{{ Storage::url('avatar/' . $user->avatar) }}" class="card-img-top user_logo_post" alt="">
                                    <small><b>{{ $user->name }}</b></small>
                                    <small>3.5</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </aside>
            </div>
        </div>
    </div>
    <div class="loader text-center {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800' }}" style="display: none">
        <div class="flex justify-center">
            <div class="spinner-border {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800' }}" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    </div>
    <script>
        var ENDPOINT = "{{ route('home') }}";
        var page = 1;
        var loading = false;
        $(document).ready(function() {
            page++;
            loadMore(page);
        });
    
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20) && !loading) {
                page++;
                loadMore(page);
            }
        });
    
        function loadMore(page) {
            loading = true; 
            $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "json",
                type: "GET",
                beforeSend: function () {
                    $(".loader").show();
                },
                success: function(response) {
                    if (response.html == '') {
                        $('.loader').html("End");
                        return;
                    }
                    $('.loader').hide();
                    $("#data-wrapper").append(response.html);
                    loading = false;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
    </script>    
</body>
</x-app-layout>
