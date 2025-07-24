@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Brands</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Brand Management</a></li>
                        <li class="breadcrumb-item active">All Brands</li>
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
                                <thead>
                                    <tr>
                                        <th>Brand Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($brand->brand_image) }}" alt="Brand Image"
                                                    class="avatar-sm">
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
                                                <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm(
                                                            'Are you sure you want to delete this brand? This action cannot be undone.'
                                                        )">Delete</button>
                                                </form>
                                            </td>
                                            {{-- Create a modal for editing the brand --}}
                                            <div class="modal fade" id="editModal{{ $brand->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $brand->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $brand->id }}">
                                                                Edit Brand</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.brands.update', $brand->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="old_image"
                                                                value="{{ $brand->brand_image }}"> {{-- Store old image path --}}
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="brand_name" class="form-label">Brand
                                                                        Name</label>
                                                                    <input type="text" name="brand_name"
                                                                        class="form-control" id="brand_name"
                                                                        value="{{ $brand->brand_name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="brand_image" class="form-label">Brand
                                                                        Image</label>
                                                                    <input type="file" name="brand_image"
                                                                        class="form-control" id="brand_image">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <img id="editImagePreview{{ $brand->id }}"
                                                                        src="{{ asset($brand->brand_image) }}"
                                                                        alt="Image Preview"
                                                                        style="display: block; max-width: 100%;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="brand_description"
                                                                        class="form-label">Description</label>
                                                                    <textarea name="brand_description" class="form-control" id="brand_description">{{ $brand->brand_description }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" id="status"
                                                                        class="form-control">
                                                                        <option value="1"
                                                                            {{ $brand->status == 1 ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="0"
                                                                            {{ $brand->status == 0 ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"> Close</button>
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
                            <h5 class="card-title">Add New Brand</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.brands.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                </div>
                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                </div>
                                {{-- show image preview --}}
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview"
                                        style="display: none; max-width: 100%;">
                                </div>
                                <div class="mb-3">
                                    <label for="brand_description" class="form-label">Description</label>
                                    <textarea name="brand_description" class="form-control" id="brand_description"></textarea>
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
