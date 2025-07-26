@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Category</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Category Management</a></li>
                        <li class="breadcrumb-item active">All Category</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Category List</h5>
                            <a href="#" class="btn btn-primary">Add Category</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                            {{-- $table->string('name')->unique();
                                                $table->string('slug')->unique();
                                                $table->string('image')->nullable();
                                                $table->text('description')->nullable();
                                                $table->boolean('status')->default(true); // true for active, false for inactive --}}
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                                        style="width: 50px; height: 50px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center">
                                                {{-- Display status as Active or Inactive --}}
                                                {{ $item->status ? 'Active' : 'Inactive' }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    Edit
                                                </button>
                                                {{-- Delete button --}}

                                               <form action="{{ route('admin.categories.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm(
                                                            'Are you sure you want to delete this brand? This action cannot be undone.'
                                                        )">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        {{-- crate a modal for editing category --}}
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.categories.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Category Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="slug" class="form-label">Slug</label>
                                                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $item->slug }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Image</label>
                                                                <input type="file" class="form-control" id="brand_image" name="image" accept="image/*">
                                                                <img id="imagePreview{{ $item->id }}" src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="display: block; width: 100px; height: 100px; margin-top: 10px;">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status">
                                                                    <option value="1" {{ $item->status ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ !$item->status ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Update Category</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add New Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.categories.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="brand_image" name="image" accept="image/*">
                                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 100px; height: 100px; margin-top: 10px;">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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
