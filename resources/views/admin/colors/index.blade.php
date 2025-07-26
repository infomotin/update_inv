@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Colors</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Color Management</a></li>
                        <li class="breadcrumb-item active">All Colors</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Color List</h5>
                            <a href="#" class="btn btn-primary">Add Color</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    {{-- $table->string('color_name')->unique();
                                        $table->string('hex_code')->unique()->nullable();
                                        $table->string('description')->nullable();
                                        $table->boolean('is_active')->default(true);
                                        $table->string('color_group')->default(false); --}}
                                    <tr>
                                        <th>Color Name</th>
                                        <th>Hex Code</th>
                                        <th>Description</th>
                                        <th>Active Status</th>
                                        <th>Color Group</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $item)
                                        <tr>
                                            <td>{{ $item->color_name }}</td>
                                            <td>{{ $item->hex_code }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $item->color_group }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editColorModal{{ $item->id }}">Edit</a>
                                                <form action="{{ route('admin.colors.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Edit Color Modal -->
                                        <div class="modal fade" id="editColorModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editColorModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editColorModalLabel{{ $item->id }}">Edit Color</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.colors.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="mb-3">
                                                                <label for="color_name" class="form-label">Color Name</label>
                                                                <input type="text" class="form-control" id="color_name"
                                                                    name="color_name" value="{{ $item->color_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="hex_code" class="form-label">Hex Code</label>
                                                                <input type="text" class="form-control" id="hex_code"
                                                                    name="hex_code" value="{{ $item->hex_code }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="description"
                                                                    name="description">{{ $item->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="is_active" class="form-label">Active Status</label>
                                                                <select class="form-select" id="is_active"
                                                                    name="is_active">
                                                                    <option value="1" {{ $item->is_active ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="color_group" class="form-label">Color Group</label>
                                                                <input type="text" class="form-control"
                                                                    id="color_group" name="color_group"
                                                                    value="{{ $item->color_group }}">
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Update Color</button>
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
                            <h5 class="card-title">Add New Color</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.colors.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="color_name" class="form-label">Color Name</label>
                                    <input type="text" class="form-control" id="color_name" name="color_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="hex_code" class="form-label">Hex Code</label>
                                    <input type="text" class="form-control" id="hex_code" name="hex_code"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Active Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="color_group" class="form-label">Color Group</label>
                                    <input type="text" class="form-control" id="color_group" name="color_group">
                                </div>
                                <button type="submit" class="btn btn-primary">Add New Color</button>
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
