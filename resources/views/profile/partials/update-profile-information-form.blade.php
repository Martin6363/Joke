<section class="bg-gray-100 dark:bg-gray-800">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 w-full d-flex gap-5">
        @csrf
        @method('patch')
        <div class="w-50 d-flex flex-col gap-2">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button class="text-dark">{{ __('Save') }}</x-primary-button>
                
                @if (session('status') === 'profile-updated')
                <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
        <div class="profile_img_update_cont">
            <div class="card text-gray-200 dark:bg-gray-900">
                <div class="card-header">
                    Your Avatar
                </div>
                <div class="card-body">
                    <div class="avatar_profile">
                        <img src="{{ Storage::url('avatar/' . Auth::user()->avatar) }}" aria-errormessage="None" class="avatar_image" alt="">
                        <input type="file" class="crop_image" name="avatar" id="crop_image" accept="image/*">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
            </div>
              
              <!-- Modal -->
              <div class="modal fade" id="image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-lime-50">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close" style="background: #f2f2f2" data-bs-dismiss="modal" title="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="width: 100%; margin-top:5px;" id="image_demo"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </form>
</section>

<script>
    $(document).ready(function() {
        var $image_crop_croppie = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#crop_image').on('change', function () {
            var reader = new FileReader();

            reader.onload = function (event) {
                $image_crop_croppie.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            };
            reader.readAsDataURL(this.files[0]);
            $('#image_modal').modal('show'); // method to show modal
        });
    });

</script>
