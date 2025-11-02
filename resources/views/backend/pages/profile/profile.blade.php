@extends('backend.layouts.master')

@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="pt-4 card-body profile-card d-flex flex-column align-items-center">
                        <img 
                            src="{{ auth()->user() && auth()->user()->image ? asset('backend/assets/images/users/' . auth()->user()->image) : asset('uploads/user.png') }}" 
                            alt="Profile" 
                            class="rounded-circle"
                        >
                        <h2>{{ auth()->user()->fname ?? 'Guest' }} {{ auth()->user()->lname ?? '' }}</h2>
                        <h3>{{ auth()->user()->type ?? 'User' }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="pt-3 card-body">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="pt-2 tab-content">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"> {{ auth()->user()->fname }} {{ auth()->user()->lname }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"> {{ auth()->user()->email }} </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8"> {{ auth()->user()->phone }} </div>
                                </div>
                            </div>

                            <div class="pt-3 tab-pane fade profile-edit" id="profile-edit">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 row">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImagePreview" src="{{ auth()->user() && auth()->user()->image ? asset('backend/assets/images/users/' . auth()->user()->image) : asset('uploads/user.png') }}" 
                                                alt="Profile">
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"
                                                    onclick="document.getElementById('profileImageUpload').click();">
                                                    <i class="bi bi-upload"></i>
                                                </a>
                                                <input type="file" id="profileImageUpload" name="image"
                                                    style="display: none;" accept="image/*"
                                                    onchange="previewProfileImage(event)" />
                                                <a href="#" class="btn btn-danger btn-sm"
                                                    title="Remove my profile image" onclick="removeProfileImage();"><i
                                                        class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <input name="uid" type="text" class="form-control d-none" id="uid"
                                        value="{{ auth()->user()->id }}">

                                    <div class="mb-3 row">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" id="fName"
                                                value="{{ auth()->user()->fname }}">
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <label for="lName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="lName" type="text" class="form-control" id="lName"
                                                value="{{ auth()->user()->lname }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ auth()->user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>


                            <div class="pt-3 tab-pane fade" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('profile.reset') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <input name="uid" type="text" class="form-control d-none" id="uid"
                                        value="{{ auth()->user()->id }}">


                                    <div class="mb-3 row">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                                type="password" name="current_password" placeholder="******">
                                            @if ($errors->has('current_password'))
                                                <div class="invalid-feedback">{{ $errors->first('current_password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                type="password" name="password" placeholder="******">
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                            New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input
                                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                type="password" name="password_confirmation" placeholder="******">
                                            @if ($errors->has('password_confirmation'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


<!-- ======= js ======= -->
<script>
    function previewProfileImage(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const preview = document.getElementById('profileImagePreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Set the src attribute to the file's data URL
            }

            reader.readAsDataURL(file); // Convert the file to a data URL
        }
    }

    function removeProfileImage() {
        const fileInput = document.getElementById('profileImageUpload');
        const preview = document.getElementById('profileImagePreview');

        // Clear the file input
        fileInput.value = '';

        // Reset the image preview to the default image
        preview.src = '{{ asset('uploads/user.png') }}';

        // Optionally, you can also add code here to handle additional UI updates if needed.
    }
</script>
