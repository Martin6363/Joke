<x-app-layout>
    <div class="py-12">
        <div class="container mt-5" style="width: 70%">            
            <h2 class="{{ $theme == 'dark' ? 'text-gray-100' : 'text-gray-800'}} m-3">
                <span class="text-gray-500">Searched results: </span>
                <b>{{$search ? $search : ''}}</b>
            </h2>
            
            @if(count($posts) > 0)
                @foreach ($posts as $post) 
                    <x-user-and-post-section :user="$post->user" :post="$post" :theme="$theme" />
                @endforeach

                @else
                <span>No Searched Results</span>
            @endIf
        </div>
    </div>
</x-app-layout>