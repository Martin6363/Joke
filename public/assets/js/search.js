console.log('Barev');
var selectedResultIndex = -1;

$(document).ready(function () {
    $('#search').attr("autocomplete", "off");
    var delayTimer;
    $(document).ready(function () {
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
                        data: { search: search },
                        success: function(data) {
                            $('#list-search').empty();
                            if (data.posts.length === 0) {
                                $('#list-search').append('<ul>No Result</ul>');
                            } else {
                                $.each(data.posts, function(index, post) {
                                    $('#list-search').append('<li><a href="" class="searched_href" data-post-id="' + post.id + '"><i class="fa fa-search" style="font-size: 13px"></i>' + post.title + '</a></li>');
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
                }, 500);
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
                var $selectedResult = $results.eq(selectedResultIndex);
                var postId = $selectedResult.data('post-id');
                var postTitle = $selectedResult.text();
                $('#search').val(postTitle); 
            }
        });
    });

    
    $('#search_btn').on('click', function () {
        var search = $('#search').val().trim();
        if (search.length === 0) {
            $('#search').focus();
        } else {
            $.ajax({
                type: "GET",
                url: "{{ route('search') }}",
                data: { search: search },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
