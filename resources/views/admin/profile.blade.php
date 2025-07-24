@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Profile</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ !empty($adminData->avatar) ? url($adminData->avatar) : url('upload/no_image.jpg') }}"
                                        class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                                    <div class="overflow-hidden ms-4">
                                        <h4 class="m-0 text-dark fs-20">{{ $adminData->name }}</h4>
                                        <p class="my-1 text-muted fs-16">{{ $adminData->email }}</p>
                                        <p class="text-muted mb-0">Joined on
                                            {{ date('d M Y', strtotime($adminData->created_at)) }}</p>
                                        <p class="text-muted mb-0">Role: {{ Str::ucfirst($adminData->role) }}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Personal Information</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>
                                                <form action="{{ route('admin.profile.update') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $adminData->id }}">
                                                    <input type="hidden" name="old_image" value="{{ $adminData->avatar }}">
                                                    <div class="card-body ">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Full Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="text" name="name"
                                                                    id="name" value="{{ $adminData->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">User Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="text" name="username"
                                                                    id="username" value="{{ $adminData->username }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Contact Phone</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-phone-outline"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        name="phone" id="phone" placeholder="Phone"
                                                                        aria-describedby="basic-addon1"
                                                                        value="{{ $adminData->phone ?? '1234567890' }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Email Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-email"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $adminData->email }}" placeholder="Email"
                                                                        name="email" id="email"
                                                                        aria-describedby="basic-addon1" readonly>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <textarea name="address" id="address" class="form-control">{{ $adminData->address }}</textarea>
                                                            </div>
                                                        </div>
                                                        {{-- image upload --}}
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Profile Image</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input type="file" name="avatar" class="form-control"
                                                                    id="avatar">
                                                            </div>
                                                        </div>

                                                        {{-- show image --}}
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Current Image</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <img id="showImage" class="rounded avatar-lg"
                                                                    src="{{ !empty($adminData->avatar) ? url($adminData->avatar) : url('upload/no_image.jpg') }}"
                                                                    alt="Profile Image">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Profile</button>
                                                                <button type="button"
                                                                    class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <!--end card-body-->
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6">
                                            <form action="#" method="get" enctype="multipart/form-data" id="changePasswordForm">
                                                @csrf
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Change Password</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>

                                                    <div class="card-body mb-0">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Old Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    name="old_password" id="old_password"
                                                                    placeholder="Old Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">New Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    name="new_password" id="new_password"
                                                                    placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Confirm Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    name="confirm_password" id="confirm_password"
                                                                    placeholder="Confirm Password">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Change
                                                                    Password</button>
                                                                <button type="button"
                                                                    class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div><!--end card-body-->
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end education -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>

    <script>
        $(document).ready(function() {
            $('#avatar').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle the change password form submission
            $('#changePasswordForm').submit(function(e) {
                //get the form data
                var oldPassword = $('#old_password').val();
                var newPassword = $('#new_password').val();
                var confirmPassword = $('#confirm_password').val();
                // Validate the form data
                if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
                    alert('All fields are required.');
                    return false;
                }
                if (newPassword !== confirmPassword) {
                    alert('New password and confirm password do not match.');
                    return false;
                }
                // Prevent the default form submission
                e.preventDefault();
                // Add your AJAX call here to handle password change
                alert('Password change functionality is not implemented yet.');
            });
        });
    </script>
@endsection
