<div class="container">
    <div class="shadow rounded p-2 mx-auto mb-4 d-flex bg-gray-100 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-gray-100 text-gray-900'}}">
        <div class="position-relative m-2">
            <div class="position-relative mr-3" style="width: 65px; height:65px; border-radius:50%; border: 2px solid #c2bcbb; padding: 1px;">
                <img src="{{ Storage::url('avatar/' . Auth::user()->avatar) }}" alt="..." class="img-fluid rounded-circle">
                <span class="follower_name" style="font-size: 12px">{{ Auth::user()->name }}</span>
                <a wire:navigate href="/create/story">
                    <span class="position-absolute top-2 start-100 translate-middle bg-secondary border border-light rounded-circle d-flex items-center justify-center" style="width: 25px; height: 25px">
                        <span style="font-size: 12px"><i class="fa-solid fa-plus"></i></span>
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="carousel m-0 overflow-hidden" style="max-width: 100%;">
            @foreach ($followers as $follower)
                <div class="position-relative m-2 pl-2 d-flex justify-center items-center flex-column">
                    <div class="position-relative" style="width: 70px; height:70px; border-radius:50%; border: 2px solid #e84118; padding: 1px;">
                        <img src="{{ Storage::url('avatar/' . $follower->avatar) }}" alt="{{ $follower->name }}" class="img-fluid rounded-circle w-full" style="height: 100%; vertical-align: middle;">
                    </div>
                    <span class="follower_name" style="font-size: 12px">{{ $follower->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
   </div>

<script>
    $(document).ready(function(){
        $('.carousel').slick({
            slidesToShow: {{ $followers->count() < 7 ? $followers->count() : 6 }},
                arrows:true,
                infinite: false,
                prevArrow: '<button type="button" class="slick-custom-arrow slick-prev position-absolute left-0 top-50 translate-middle m-2 z-2"> <i class="fa-solid fa-chevron-left"></i> </button>',
                nextArrow: '<button type="button" class="slick-custom-arrow slick-next position-absolute right-0 top-50 translate-middle"> <i class="fa-solid fa-chevron-right"></i> </button>',
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                ]
        });
        $('.follower_name').each(function() {
            let text = $(this).text();
            if (text.length > 10) {
                $(this).text(text.substring(0, 10) + '...')
            }
        });
    });
</script>