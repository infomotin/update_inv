@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Sizes</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Size Management</a></li>
                        <li class="breadcrumb-item active">All Sizes</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Size List</h5>
                            <a href="#" class="btn btn-primary">Add Size</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                   {{-- $table->string('size_name')->unique();
                                        $table->string('description')->nullable();
                                        $table->boolean('is_active')->default(true);
                                        $table->string('size_group')->default(false);
                                        $table->string('unit_id')->nullable(); // Assuming you want to link sizes to units
                                        $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade'); // Foreign key constraint to units table
                                        $table->string('symbol')->nullable(); // Optional symbol for size
                                        $table->boolean('is_base_size')->default(false); // Indicates if this is a base size
                                        $table->double('conversion_value', 8, 2)->default(0.00); // Conversion value for size --}}
                                    <tr>
                                        <th>Size Name</th>
                                        <th>Description</th>
                                        <th>Active Status</th>
                                        <th>Base Size</th>
                                        <th>Conversion Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($sizes as $item)

                                        <tr>
                                            <td>{{ $item->size_name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $item->is_base_size ? 'Yes' : 'No' }}</td>
                                            <td>{{ $item->conversion_value }}</td>
                                            <td>
                                                <a href="{{ route('admin.sizes.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</a>
                                                <form action="{{ route('admin.sizes.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        {{-- load edit modal --}}
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Size</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.sizes.update', $item->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')

                                                            <div class="mb-3">
                                                                <label for="size_name" class="form-label">Size Name</label>
                                                                <input type="text" class="form-control" id="size_name"
                                                                    name="size_name" value="{{ $item->size_name }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Description</label>
                                                                <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                                                            </div>

                                                            <div class="mb-3 form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="is_active" name="is_active"
                                                                    {{ $item->is_active ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="is_active">Is Active</label>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Update Size</button>
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
                            <h5 class="card-title">Add New Size</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sizes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="size_name" class="form-label">Size Name</label>
                                    <input type="text" class="form-control" id="size_name" name="size_name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                        checked>
                                    <label class="form-check-label" for="is_active">Is Active</label>
                                </div>
                                <div class="mb-3">
                                    <label for="is_base_size" class="form-label">Is Base Size</label>
                                    <input type="checkbox" class="form-check-input" id="is_base_size" name="is_base_size">
                                    <label class="form-check-label" for="is_base_size">Is Base Size</label>
                                </div>
                                <div class="mb-3">
                                    <label for="conversion_value" class="form-label">Conversion Value</label>
                                    <input type="number" class="form-control" id="conversion_value" name="conversion_value" step="0.01" value="0.00">
                                </div>

                                <button type="submit" class="btn btn-primary">Add New Size</button>
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
