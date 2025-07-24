@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Ware Houses</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ware House Management</a></li>
                        <li class="breadcrumb-item active">All Ware Houses</h4>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Brand List</h5>
                            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Add Brand</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">

                                {{-- $table->string('name')->unique();
                                        $table->string('address1');
                                        $table->string('address2')->nullable();
                                        $table->string('city');
                                        $table->string('state');
                                        $table->string('zip_code');
                                        $table->string('country');
                                        $table->string('phone')->nullable();
                                        $table->string('email')->nullable();
                                --}}
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Address </th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($warehouse as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->logo) }}" alt="Logo" class="avatar-sm">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->address1 }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->state }}</td>
                                            <td>{{ $item->country }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="#" class="btn btn-primary btn-sm"
                                                    data-bs-target="#editModal{{ $item->id }}"
                                                    data-bs-toggle="modal">Edit</a>
                                                <form action="{{ route('admin.warehouses.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </td>
                                            {{-- create modal --}}
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                                Edit Ware House</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.warehouses.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            {{-- <input type="hidden" name="old_image"
                                                                value="{{ $item->logo }}"> --}}
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="name"
                                                                        value="{{ $item->name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="logo" class="form-label">Logo</label>
                                                                    <input type="file" name="logo"
                                                                        class="form-control" id="logo">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <img id="editImagePreview{{ $item->id }}"
                                                                        src="{{ asset($item->logo) }}" alt="Image Preview"
                                                                        style="display: block; max-width: 100%;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="address1" class="form-label">Address
                                                                        1</label>
                                                                    <input type="text" name="address1"
                                                                        class="form-control" id="address1"
                                                                        value="{{ $item->address1 }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="address2" class="form-label">Address
                                                                        2</label>
                                                                    <input type="text" name="address2"
                                                                        class="form-control" id="address2"
                                                                        value="{{ $item->address2 }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="city" class="form-label">City</label>
                                                                    <input type="text" name="city"
                                                                        class="form-control" id="city"
                                                                        value="{{ $item->city }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="state" class="form-label">State</label>
                                                                    <input type="text" name="state"
                                                                        class="form-control" id="state"
                                                                        value="{{ $item->state }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="zip_code" class="form-label">Zip
                                                                        Code</label>
                                                                    <input type="text" name="zip_code"
                                                                        class="form-control" id="zip_code"
                                                                        value="{{ $item->zip_code }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="country"
                                                                        class="form-label">Country</label>
                                                                    <input type="text" name="country"
                                                                        class="form-control" id="country"
                                                                        value="{{ $item->country }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </div>
                                                        </form>
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
                            <h5 class="card-title">Add New Ware House</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview"
                                        style="display: none; max-width: 100%;">
                                </div>
                                <div class="mb-3">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <input type="text" name="address1" class="form-control" id="address1">
                                </div>
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input type="text" name="address2" class="form-control" id="address2">
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" id="city">
                                </div>
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" id="state">
                                </div>
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code" class="form-control" id="zip_code">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="country">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
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


{{-- <tr>
    <td>
        <img src="{{ asset($brand->brand_image) }}" alt="Brand Image" class="avatar-sm">
    </td>
    <td>{{ $brand->brand_name }}</td>
    <td>{{ Str::limit($brand->brand_description, 20) }}</td>
    <td>
        @if ($brand->status == 1)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>
    <td>
        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
            data-bs-target="#editModal{{ $brand->id }}">Edit</a>
        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(
                                                            'Are you sure you want to delete this brand? This action cannot be undone.'
                                                        )">Delete</button>
        </form>
    </td>

    <div class="modal fade" id="editModal{{ $brand->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $brand->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $brand->id }}">
                        Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="brand_name" class="form-label">Brand
                                Name</label>
                            <input type="text" name="brand_name" class="form-control" id="brand_name"
                                value="{{ $brand->brand_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="brand_image" class="form-label">Brand
                                Image</label>
                            <input type="file" name="brand_image" class="form-control" id="brand_image">
                        </div>
                        <div class="mb-3">
                            <img id="editImagePreview{{ $brand->id }}" src="{{ asset($brand->brand_image) }}"
                                alt="Image Preview" style="display: block; max-width: 100%;">
                        </div>
                        <div class="mb-3">
                            <label for="brand_description" class="form-label">Description</label>
                            <textarea name="brand_description" class="form-control" id="brand_description">{{ $brand->brand_description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</tr> --}}
