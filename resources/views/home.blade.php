<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 mt-10" style="width: 60%">
            <div class="bg-gray-100 {{ $theme == 'dark' ? 'bg-gray-800' : 'bg-light'}} overflow-hidden shadow-sm sm:rounded-lg d-flex justify-between">
                <nav class="bg-gray-100 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-light text-gray-800'}} main_left_nav" id="dashboard_left_nav">
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
                            <div class="accordion-item {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}}" style="border-radius: 5px">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Category
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse visible collapse {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}}" style="border-radius: 5px" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                @foreach ($categories as $category)
                                    <a href="{{ route('post.create') }}" class="accordion-body btn w-full text-left {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-700' }} hover:bg-gray-400 p-2">{{ $category->name }}</a>
                                @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="p-6 {{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-900'}} content-middle">
                    @foreach ($usersWithPosts as $key => $user)
                        @foreach ($user->posts as $post)
                            @if ($post->user_id >= 1)
                                <x-user-and-post-section :user="$user" :post="$post" :theme="$theme" />
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <aside class="{{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-light text-gray-800'}} main_right_aside" id="aside">
                    ASIDE CONTENT
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
