<div>    
  <div class="collapse visible show" style="width: 100%" id="collapseExample{{ $post->id }}">
      <div class="card card-body p-0 w-full {{ $theme == 'dark' ? 'bg-gray-900 text-gray-200' : 'bg-gray-200 text-gray-900'}}">
        <strong class="m-2" style="font-size: 15px">{{ $comments->count() }} Comments</strong>
          <div class="comments_user m-2">
            @foreach ($comments as $comment)
              <div class="d-flex flex-start mb-3">
                <a href="{{ route('profile.view', [$comment->user->id]) }}" wire:navigate class="mr-2" style="width: 50px; height: 50px">
                  <img class="comentor_avatar"
                    src="{{ Storage::url('avatar/' . $comment->user->avatar) }}" alt="avatar"
                  />
                </a>
                <div class="card w-100 mr-2 border-none">
                  <div class="card-body p-2 comment_box {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-200 text-gray-900'}}" style="border-radius: 5px">
                    <div>
                      <div class="d-flex flex-row justify-between items-center gap-2 w-full">
                        <div class="w-full d-flex items-center gap-2">
                          <small style="font-size: 15px">{{ $comment->user->name }}</small>
                          <span class="text-gray-500" style="font-size: 12px">●</span>
                          <p class="small" style="font-size: 12px">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <x-dropdown align="right" width="38">
                          <x-slot name="trigger">
                              <span class="active:bg-gray-400 p-1 comment_action" style="cursor: pointer; border-radius: 100px;"><i class="fa-solid fa-ellipsis"></i></span>
                          </x-slot>
                          <x-slot name="content" class=" {{ $theme == 'dark' ? 'bg-gray-800 text-gray-100' : 'bg-light text-gray-900'}}">
                              {{-- @if (Auth::user()->id === $post->user_id) --}}
                                  <button type="button" wire:click="edit({{ $comment->id }})" class="flex justify-between w-full {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out">
                                      <i class="fa-solid fa-pen"></i>
                                  </button>
                                  <button type="button" class="w-full flex justify-between {{ $theme == 'dark' ? 'text-gray-800 hover:bg-gray-500 focus:bg-gray-800' : 'text-gray-700 hover:bg-gray-100 focus:bg-gray-100' }} px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $post->id }}">
                                      <i class="fa-solid fa-trash"></i>
                                  </button>
                              {{-- @else
                                  <span class="m-2 text-muted">No Info</span>
                              @endif --}}
                          </x-slot>
                      </x-dropdown>
                      </div>
                      <p style="font-size: 16px">
                        {{ $comment->message }}
                      </p>
      
                      <div class="comment_like_box d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center mt-2" style="font-size: 16px">
                          <a href="#!" class="link-muted me-2 d-flex items-center">
                            <i class="fa-regular fa-heart"></i><small>13</small>
                          </a>
                          <button wire:click="replyTo({{ $comment->id }})" type="button" class="link-muted d-flex items-center" id="reply" data-toggle="reply-form" data-target="{{ 'comment-' . $comment->id . '-reply-form'}}">
                            <i class="fas fa-reply me-1"></i>
                            <small>Reply</small>
                          </button>
                        </div>
                      </div>
                      <!-- Reply section -->
                      @if ($replyToCommentId === $comment->id)
                        <form method="POST" class="reply-form ml-2 mt-2 {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-900'}}" style="display: block" id="{{ 'comment-' . $comment->id . '-reply-form'}}">
                          <div class="d-flex items-center gap-2 ml-2">
                            <img src="{{ Storage::url('avatar/' . Auth::user()->avatar) }}" class="rounded-full" style="width: 35px; height: 35px;" alt="Avatar">         
                            <div class="d-flex flex-row h-10 w-full">
                              <textarea wire:model.defer="comment" id="reply_message" data-id="{{ $comment->reply_id ?? '' }}" class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-200 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" aria-label="With textarea" placeholder="Reply"></textarea>                                      
                            </div>  
                          </div>
                          <div class="d-flex items-center mt-2 w-full justify-end">
                            <button type="button" wire:click="replyComment" class="btn bg-transparent btn-sm {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-900'}}">Reply</button>
                            <button type="button" class="btn btn-sm {{ $theme == 'dark' ? 'text-gray-200' : 'text-gray-900'}}" data-action="cancel-reply" data-target="{{ 'comment-' . $comment->id . '-reply-form'}}">Cancel</button>
                          </div>
                        </form>
                      @endif

                      <!-- Replies -->
                      @if ($comment->replies->count() > 0) 
                        <button class="toggle-replies-{{ $comment->id ?? '' }} d-flex items-center gap-2 text-blue-500 cursor-pointer mt-2" style="font-size: 15px" data-id="{{ $comment->id ?? '' }}">
                          <span class="toggle-arrow" style="font-size: 10px">▼</span> ({{ $comment->replies->count() }}) replies
                        </button>
                      @endif
                      <div class="mt-2 replies_container" id="replies_container-{{ $comment->id }}" style="display: none">
                        @foreach($comment->replies as $reply)
                          <div class="d-flex g-2 mb-2 ml-5">
                            <a href="{{ route('profile.view', [$reply->user->id]) }}" wire:navigate class="mr-1"> 
                              <img src="{{ Storage::url('avatar/' . $reply->user->avatar) }}" class="rounded-full" style="width: 35px; height: 35px;" alt="Avatar">
                            </a>
                            <div class="d-flex flex-col ml-2">
                              <div class="d-flex items-center gap-2">
                                <a href="{{ route('profile.view', [$reply->user->id]) }}" wire:navigate class="{{ $theme == "dark" ? ' text-gray-200 ' : 'text-gray-800' }}" style="white-space: nowrap; font-size: 15px;"> 
                                  <span>{{ $reply->user->name }}</span>
                                </a> 
                                <span class="text-gray-500" style="font-size: 12px">●</span>
                                <small style="font-size: 10px">{{ $reply->created_at->diffForHumans() }}</small>
                              </div>
                              <span style="font-size: 15px">{{ $reply->reply_text }}</span>
                            </div>
                          </div>  
                        @endforeach
                      </div>                    
                      <!--Reply Section End-->                       
                    </div>
                  </div>
                </div>
              </div>
            @endforeach  
          </div>
          <div class="card-footer border-top p-0">
            <div class="input-group d-flex items-center gap-2">
              <div class="comment_content_box mx-3 mt-2">
                <img src="{{ Storage::url('avatar/'. Auth::user()->avatar) }}" class="comment_avatar" alt="Post Image">
                <textarea wire:model="comment" id="message" data-id="{{ $comment->id ?? '' }}" class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-900 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" aria-label="With textarea" placeholder="Comment"></textarea>
                <button wire:click.prevent="postComment" id="send_comment_btn" class="input-group-text send_comm_btn" style="padding: 10px; border-radius: 100px">
                  <i class="fa-regular fa-paper-plane"></i>
                </button>
              </div>
              <small class="p-2" style="font-size: 14px"><span class="counter-{{ $comment->id ?? '' }}">1000</span>/1000</small>
            </div>
          </div>
      </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("[id^='reply']").on('click', function() {
    var targetForm = $(this).data('target');
    $('[id^="comment-"]').hide();
    $('#' + targetForm).show(); 
    $('#' + targetForm + ' #reply_message').focus();
  });

  $(document).on('click', '[data-action="cancel-reply"]', function() {
    var targetForm = $(this).data('target');
    $('#' + targetForm).hide();
    $('#' + targetForm + ' #reply_message').val("");
  });

  $("[id^='message']").on('input', function (e) {
    const id = $(this).data('id');
    const target = e.target;
    const maxLength = 1000;
    let currentLength = maxLength - target.value.length;

    $('.counter-' + id).text(Math.max(currentLength, 0));

    if (currentLength < 0) {
        target.value = target.value.slice(0, maxLength);
        currentLength = 0;
    }
  });
});

$(document).ready(function() {
  $("[class^='toggle-replies-']").on('click', function() {
    var commentId = $(this).data('id');
    console.log("Toggle button clicked. Comment ID: " + commentId); // Log the commentId
    $('#replies_container-' + commentId).toggle();

    // Toggle the arrow icon
    $(this).find('.toggle-arrow').text(function(_, text) {
      return text === '▼' ? '▲' : '▼';
    });
  });
});


</script>
