<form action="{{ route('search.posts') }}" id="search_form" method="GET">
    <div class="search_container p-1 w-full rounded rounded-pill shadow-sm position-relative {{ $theme == 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-gray-300 text-gray-800' }}">
        <div class="search_box">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-link text-warning" id="search_btn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <input type="search" placeholder="Search" name="search" value="{{ old('search') }}"  aria-describedby="button-addon2" id="search" class="form-control border-0 rounded rounded-pill {{ $theme == 'dark' ? 'bg-gray-600 text-gray-100' : 'bg-gray-100 text-gray-800' }}"/>
            <div id="list-search" class="searched_list shadow-sm {{ $theme == 'dark' ? 'bg-dark text-gray-100' : 'bg-gray-500 text-gray-800'}}" style="width: 100%; border-radius: 0; margin-top: -1px; position:absolute">
            </div>
        </div>
    </div>
</form>

<script>
   $(document).ready(function () {
    var selectedResultIndex = -1;
    var postUrl = "{{ route('search.result', ':name') }}"; 
    
    $('#search').attr("autocomplete", "off");
    var delayTimer;
        $('#search').on('keyup', function (event) {
            var search = $('#search').val().trim();
            clearTimeout(delayTimer);
            if (search.length === 0) {
                $('#list-search').hide();
            } else {
                delayTimer = setTimeout(function() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('search') }}",
                        data: { data: search },
                        success: function(data) {
                            $('#list-search').empty();
                            if (data.posts.length === 0) {
                                $('#list-search').append('<li><a href="' + postUrl + '" class="searched_href"><i class="fa fa-search" style="font-size: 13px"></i>' + search + '</a></li>');
                            } else {
                                $.each(data.posts, function(index, post) {
                                    var postUrl = "{{ route('search.result', ':name') }}"; 
                                    postUrl = postUrl.replace(':name', post.title); 
                                    $('#list-search').append('<li><a href="' + postUrl + '" class="searched_href" data-post-id="' + post.id + '"><i class="fa fa-search" style="font-size: 13px"></i>' + post.title + '</a></li>');
                                });
                                // Reset selected result index
                                selectedResultIndex = -1;
                            }
    
                            if (data.posts.length > 3) {
                                $('#list-search').addClass('scrollable');
                            } else {
                                $('#list-search').removeClass('scrollable');
                            }
                            $('#list-search').show();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }, 300);
            }
        });

        $('#search').on('keydown', function(event) {
            var $results = $('#list-search').find('a');
            var numResults = $results.length;

            // Handle arrow key navigation
            if (event.keyCode === 38) {
                event.preventDefault(); 
                selectedResultIndex = Math.max(0, selectedResultIndex - 1);
            } else if (event.keyCode === 40) { // Down arrow
                event.preventDefault(); 
                selectedResultIndex = Math.min(numResults - 1, selectedResultIndex + 1);
            }

            // Update input value based on selected result index
            if (selectedResultIndex >= 0) {
                $results.css("background-color", ""); 
                var $selectedResult = $results.eq(selectedResultIndex);
                var postId = $selectedResult.data('post-id');
                var postTitle = $selectedResult.text();
                $('#search').val(postTitle); 
                $results.eq(selectedResultIndex).css("background-color", "#838383");
            }
        });
    });


        $('#search_btn').on('click', function (e) {
            var search = $('#search').val().trim();
            if (search.length === 0) {
                e.preventDefault();
                $('#search').focus();
            } else {
                $('#search_form').submit();
            }
        })
</script>
