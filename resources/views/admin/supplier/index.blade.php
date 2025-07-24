@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Suppliers</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier Management</a></li>
                        <li class="breadcrumb-item active">All Suppliers</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Supplier List</h5>
                            <a href="#" class="btn btn-primary">Add Supplier</a>
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
                                        <th>Category</th>
                                        <th>Country</th>
                                        <th>Brand</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Website</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->category }}</td>
                                            <td>{{ $supplier->country }}</td>
                                            <td>{{ $supplier->brand }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->phone }}</td>
                                            <td>{{ $supplier->website }}</td>
                                            <td>{{ $supplier->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $supplier->id }}">Edit</a>
                                                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            {{-- create a modal for edit --}}
                                            <div class="modal fade" id="editModal{{ $supplier->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $supplier->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $supplier->id }}">Edit Supplier</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Name</label>
                                                                    <input type="text" name="name" class="form-control" id="name" value="{{ $supplier->name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="category" class="form-label">Category</label>
                                                                    <input type="text" name="category" class="form-control" id="category" value="{{ $supplier->category }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="country" class="form-label">Country</label>
                                                                    <input type="text" name="country" class="form-control" id="country" value="{{ $supplier->country }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="brand" class="form-label">Brand</label>
                                                                    <input type="text" name="brand" class="form-control" id="brand" value="{{ $supplier->brand }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" name="email" class="form-control" id="email" value="{{ $supplier->email }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="phone" class="form-label">Phone</label>
                                                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $supplier->phone }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="website" class="form-label">Website</label>
                                                                    <input type="text" name="website" class="form-control" id="website"
                                                                        value="{{ $supplier->website }}">
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update Supplier</button>
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
                            <h5 class="card-title">Add New Supplier</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.suppliers.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <input type="text" name="address1" class="form-control" id="address1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control" id="category" required>
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" id="state" required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" id="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" name="brand" class="form-control" id="brand" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="text" name="website" class="form-control" id="website" required>
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo" accept="image/*">
                                    <img id="imagePreview" src="#" alt="Logo Preview" style="display:none; max-width: 100px; margin-top: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label for="banner_image" class="form-label">Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control" id="banner_image" accept="image/*">
                                    <img id="imagePreviewBanner" src="#" alt="Banner Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">

                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
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
