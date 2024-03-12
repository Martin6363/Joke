<x-app-layout>
    <div class="py-12">
        <h1>Edit Post</h1>
        <div class="card mt-4 w-50 mx-auto p-2 pt-3  {{ $theme == 'dark' ? 'bg-gray-800 text-gray-200' : 'bg-gray-100 text-gray-800'}}">
            <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><b>Title</b></label>
                    <x-text-input name="title" class="form-control" id="exampleFormControlInput1" placeholder="title" value="{{ $post->title }}"></x-text-input>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label"><b>Description</b></label>
                    <textarea class="{{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} w-full" name="description" id="description" rows="3" placeholder="Description">{{ $post->description }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mb-3">
                  <label for="category" class="form-label"><b>Category</b></label>
                  <select class="w-full {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}}" id="category" name="category" aria-label="Default select example">
                    @foreach ($category as $value)
                      <option value="{{$value->id}}" {{ $post->category_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                    @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div class="mb-3">
                  <label for="availability" class="form-label"><b>Availability</b></label>
                  <select class="form-select w-50 form-select-sm {{ $theme == "dark" ? "bg-gray-900 text-gray-300 border-gray-700 focus:border-indigo-600 focus:ring-indigo-600" : "border-gray-300 bg-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"}} rounded-md shadow-sm" id="availability" name="published" aria-label="Default select example">
                    @foreach($postPublished as $key => $value)
                      <option value="{{ $key }}" {{ $post->published == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('published')" class="mt-2" />
                </div>
                <label class="form-label mt-3"><b>Image</b></label>
                <div class="card-input-image" id="card_input_image">
                    <input type="file" id="input_image" name="image" class="input-image" accept=".png, .jpg, .jpeg" onchange="onchange_value('input_image', 'card_input_image')"/>
                    <label for="input_image" class="label-upload-image">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m1 5h-2v4H7v2h4v4h2v-4h4v-2h-4V7Z"/>
                      </svg>
                      Upload File
                      <span class="text-muted" style="opacity: 0.5">png jpg jpeg</span>
                    </label>
                    <button type="button" class="btn-delete" onclick="delete_value('input_image', 'card_input_image')">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                        <path fill="currentColor" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/>
                      </svg>
                      Delete
                    </button>
                    <img src="{{ Storage::url('post-images/'.$post->image) }}" id="img_preview" class="image-preview" alt="Post Image" />
                  </div>
                <div class="mt-3 float-end">
                    <a href="{{ Route("home") }}" class="btn btn-danger inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-900">
                      <i class="fa-solid fa-arrow-left mr-2"></i> Back
                    </a>
                    <x-primary-button type="submit" class="bg-success">Update</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
      // handle on change
      function onchange_value(name, preview) {
          var files = $(`#${name}`).prop('files');
          if (files.length > 0) {
              var filesArr = Array.prototype.slice.call(files);
              if (filesArr[0].size > 2097152) {
                  alert(`File ${filesArr[0].name} is too big!`);
                  clearInputAndPreview(name, preview);
              } else {
                  updatePreview(name, preview, filesArr[0]);
              }
          } else {
              clearInputAndPreview(name, preview);
          }
      }
  
      // handle on click button delete
      function delete_value(name, preview) {
          clearInputAndPreview(name, preview);
      }
  
      function updatePreview(name, preview, file) {
          $(`#${preview}`).addClass('active');
          $(`#${preview} label.label-upload-image`).html('');
          $(`#${preview} img.image-preview`).attr(
              'src',
              URL.createObjectURL(file)
          );
          console.log(file.name, 'name');
      }
  
      function clearInputAndPreview(name, preview) {
          $(`#${name}`).val('');
          $(`#${preview}`).removeClass('active');
          $(`#${preview} label.label-upload-image`).html(
              "<svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24'><path fill='currentColor' d='M12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m1 5h-2v4H7v2h4v4h2v-4h4v-2h-4V7Z'/></svg>Upload File <span class='text-muted' style='opacity: 0.5'>png jpg jpeg</span>"
          );
          $(`#${preview} img.image-preview`).attr('src', '');
      }
  </script>
  
</x-app-layout>
