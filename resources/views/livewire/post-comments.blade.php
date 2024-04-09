<div>    
    <div class="collapse visible" style="width: 100%" id="collapseExample{{ $post->id }}">
        <div class="card card-body p-0 w-full {{ $theme == 'dark' ? 'bg-gray-900 text-gray-200' : 'bg-gray-200 text-gray-900'}}">
            <div class="comments_user m-2">
              @foreach ($comments as $comment)
                <div class="d-flex flex-start mb-3">
                  <a href="{{ route('profile.view', [$comment->user->id]) }}" wire:navigate class="mr-2" style="width: 50px; height: 50px">
                    <img class="rounded-circle me-3 w-100 h-100" style=""
                      src="{{ Storage::url('avatar/' . $comment->user->avatar) }}" alt="avatar" style="width: 65px; height: 65px;"
                    />
                  </a>
                  <div class="card w-100">
                    <div class="card-body p-2 {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-200 text-gray-900'}}" style="border-radius: 5px">
                      <div>
                        <div class="d-flex items-center gap-2 w-full border-bottom">
                          <small style="font-size: 15px">{{ $comment->user->name }}</small>
                          <p class="small" style="font-size: 12px">{{ $comment->created_at }}</p>
                        </div>
                        <p style="font-size: 16px">
                          {{ $comment->message }}
                        </p>
        
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mt-2" style="font-size: 16px">
                            <a href="#!" class="link-muted me-2"><i class="fas fa-thumbs-up me-1"></i>13</a>
                            <a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>15</a>
                          </div>
                          <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i> Reply</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach  
            </div>
            <div class="card-footer border-top p-0">
              <div class="input-group d-flex items-center gap-2">
                <div class="comment_content_box m-3">
                  <img src="{{ Storage::url('avatar/'. Auth::user()->avatar) }}" class="comment_avatar" alt="Post Image">
                  <textarea wire:model="comment" id="message" data-id="{{ $comment->id ?? '' }}" class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-900 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" aria-label="With textarea" placeholder="Cemment"></textarea>
                  <button wire:click="postComment" class="input-group-text send_comm_btn" style="padding: 10px; border-radius: 100px">
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
</script>