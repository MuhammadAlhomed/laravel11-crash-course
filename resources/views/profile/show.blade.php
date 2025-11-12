<x-layout>
   <div class="card bg-white">

        <div class="card-body">
            <div class="m-3 d-flex align-items-top">
                <img class="img-fluid rounded-pill" id="avatar" src="{{ Storage::url($user->avatar) }}" height=240 width=240 alt="Profile Picture"/>
                <div class="ms-4 w-100">
                    <div class="d-flex align-items-baseline justify-content-between">
                        <div>
                            <span class="h1">{{$user->name}}</span>
                            <span class="h4 text-muted">{{'@' . $user->username}}</span>
                        </div>
                        @if($user->id === auth()->user()?->id)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editProfileModal" class="btn btn-primary d-flex"><i data-feather="edit" class="me-2"></i>Edit profile</button>
                        @endif
                    </div>
                    <p class="mt-3">{{ $user->bio }}</p>
                </div>
            </div>
            </div>
    </div>

    @if($user->id === auth()->user()?->id)
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('profile.update') }}" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editProfileModalTitle">Edit profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body bg-white" id="editProfileModalBody">
                        @csrf
                        <div class="upload-progress" progress=0 >
                        </div>
                        <div class="mb-2 d-flex justify-content-center">
                            <div class="profile-container">
                                <img class="profile-img img-fluid rounded-pill" id="editProfileModalImage" src="{{ Storage::url($user->avatar) }}" height=120 width=120 alt="Profile Picture"/>
                                <div class="profile-overlay bg-black" onclick="document.getElementById('profileImage').click();">
                                    <i data-feather="camera" class="text-white"></i>
                                </div>
                                <input type="file" name="image" accept="image/png, image/jpeg" id="profileImage" onchange="uploadImage(event)" class="d-none">
                            </div>
                        </div>

                        <x-form-label for="name" >Name</x-form-label>
                        <x-form-input name="name" type="text" placeholder="Name" value="{{ old('name', auth()->user()->name) }}"/>
                        <x-form-label for="username" >Username</x-form-label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <x-form-input name="username" type="text" placeholder='username' value="{{ old('username', auth()->user()->username) }}" required/>
                        </div>
                        <x-form-label for="bio" >Bio</x-form-label>
                        <x-form-input name="bio" type="textarea" placeholder="Your Biography here" rows=3 value="{{ old('bio', auth()->user()->bio) }}"/>
                        <hr>

                        <x-form-label for='email'>Email</x-form-label>
                        <x-form-input name="email" type="email" value="{{ old('email', auth()->user()->email) }}"></x-form-input>
                        <x-form-label for="old_password" >Old password</x-form-label>
                        <x-form-input name="old_password" type="password"/>
                        <x-form-label for="password" >New password</x-form-label>
                        <x-form-input name="password" type="password"/>
                        <x-form-label for="password_confirmation" >Confirm new password</x-form-label>
                        <x-form-input name="password_confirmation" type="password"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endif

    <div class="my-3">
    @foreach ($notes as $note)
        <div class="my-3">
            <a href="{{route('note.show', $note)}}"></a>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="card-text">
                        {!!  Str::words($note->content, 100) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <div class="col">
                            <p class=" m-0 text-secondary">
                                <span class="fs-6">Posted {{ $note->created_at->DiffForHumans() }}</span>
                            </p>
                        </div>
                        <div class="col">
                            <div class="col d-flex justify-content-end gap-1">
                                <a href={{route('note.show', $note)}} class="btn btn-primary d-inline-flex align-items-center"><i data-feather="eye" class="align-middle me-2"></i>View</a>
                                <a href={{route('note.edit', $note)}} class="btn btn-secondary d-inline-flex align-items-center"><i data-feather="edit" class="align-middle me-2"></i>Edit</a>
                                <form action="{{route('note.destroy', $note)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button href={{route('note.destroy', $note)}} class="btn btn-danger d-inline-flex align-items-center"><i data-feather="trash-2" class="align-middle me-2"></i>Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    {{ $notes->links()}}

    @push('scripts')
        <script defer>
            function uploadImage(event){
                const progressbar = document.querySelector(".upload-progress")
                const inputFileField = event.target;
                const file = inputFileField.files[0];
                const formData = new FormData();
                const csrfToken = document.querySelector("input[name='_token']")
                formData.append("image", file);

                // Doing this function with XHR for practice.
                const xhr = new XMLHttpRequest();
                xhr.open('post', "{{ route('profile.update-image') }}", true);
                xhr.responseType = "json";

                xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken.value);

                // Progress bar
                xhr.upload.onprogress = (event) => {
                    if(event.lengthComputable) {
                        progressbar.setAttribute('progress', event.loaded / event.total * 100);
                    }
                }
                // On Complete (fires on load or abort or error)
                xhr.upload.onloadend = (event) => {
                    progressbar.setAttribute('progress', 0);
                    inputFileField.value = "";
                }

                // On complete successfully
                xhr.onload = (event) => {
                    if (xhr.status === 200){
                        const results = xhr.response;
                        console.log(results);

                        const avatar = document.querySelector('#avatar');
                        const modalImage = document.querySelector('#editProfileModalImage');

                        avatar.setAttribute('src', results.image_url);
                        modalImage.setAttribute('src', results.image_url);
                    }
                }

                xhr.send(formData);
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .profile-container {
                position: relative;
                width: 120px;
                height: 120px;
                display: flex;
                border-radius: 100%;
            }
            .profile-overlay {
                position: absolute;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                opacity: 0.0;
                border-radius: 100%;
                transition: opacity 0.3s ease;
                cursor: pointer;
            }
            .profile-overlay:hover {
                opacity: 0.7;
            }
            .profile-img {

            }
            .upload-progress {
                width: clamp(0%, attr(progress %), 100%);
                height:20px;
                border-top: solid;
                border-top-width: 2px;
                border-top-color: #0d6efd;

            }

        </style>
    @endpush
</x-layout>

