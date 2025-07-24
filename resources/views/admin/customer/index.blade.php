@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Customers</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customer Management</a></li>
                        <li class="breadcrumb-item active">All Customers</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Customer List</h5>
                            <a href="#" class="btn btn-primary">Add Customer</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                            {{-- $table->string('name');
                                            $table->string('email')->unique();
                                            $table->string('type')->default('wacking'); // regular, premium, guest
                                            $table->string('category')->default('cradit'); // regular, premium, guest
                                            $table->string('phone')->nullable();
                                            $table->string('address')->nullable();
                                            $table->string('city')->nullable();
                                            $table->string('state')->nullable();
                                            $table->string('zip')->nullable();
                                            $table->string('country')->nullable();
                                            $table->string('social_media_links')->nullable();
                                            $table->string('profile_picture')->nullable();
                                            $table->string('status')->default('active'); // active, inactive, banned
                                            $table->date('DOB')->nullable(); // Date of Birth --}}
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Country</th>
                                        <th>Social Media Links</th>
                                        <th>Profile Picture</th>
                                        <th>Status</th>
                                        <th>DOB</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->type }}</td>
                                            <td>{{ $customer->category }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->state }}</td>
                                            <td>{{ $customer->zip }}</td>
                                            <td>{{ $customer->country }}</td>
                                            <td>{{ $customer->social_media_links }}</td>
                                            <td><img src="{{ asset($customer->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px;"></td>
                                            <td>{{ $customer->status }}</td>
                                            <td>{{ $customer->DOB }}</td>
                                            <td>
                                                <!-- Add action buttons here -->
                                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $customer->id }}">Edit</a>
                                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $customer->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $customer->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $customer->id }}">Edit Customer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="phone" class="form-label">Phone</label>
                                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="address" class="form-label">Address</label>
                                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="profile_picture" class="form-label">Profile Picture</label>
                                                                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add New Customer</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.customers.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="regular">Regular</option>
                                        <option value="premium">Premium</option>
                                        <option value="guest">Guest</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="credit">Credit</option>
                                        <option value="debit">Debit</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                                <div class="mb-3">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                                <div class="mb-3">
                                    <label for="social_media_links" class="form-label">Social Media Links</label>
                                    <input type="text" class="form-control" id="social_media_links" name="social_media_links">
                                </div>
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                                    <img id="imagePreview" src="#" alt="Profile Picture Preview" style="display:none; width: 100px; height: 100px;">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="banned">Banned</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="DOB" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="DOB" name="DOB" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Add New Customer</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div> <!-- container-fluid -->

    </div>
    <!-- End Content-->
    <script>
        $(document).ready(function() {
            $('#brand_image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });
        });
    </script>
@endsection
