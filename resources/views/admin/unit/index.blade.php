@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Units</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Unit Management</a></li>
                        <li class="breadcrumb-item active">All Units</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Unit List</h5>
                            <a href="#" class="btn btn-primary">Add Unit</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    {{-- $table->string('unit_name')->unique();
                                            $table->string('symbol')->unique();
                                            $table->string('std_name')->nullable();
                                            $table->boolean('is_active')->default(true);
                                            $table->boolean('is_base_unit')->default(false);
                                            $table->double('conversion_value', 8, 2)->default(0.00);
                                            $table->string('conversion_unit_id')->nullable();
                                            $table->boolean('is_base_conversion')->default(false);
                                            $table->string('description')->nullable(); --}}
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Symbol</th>
                                        <th>Standard Name</th>
                                        <th>Active Status</th>
                                        <th>Base Unit</th>
                                        <th>Conversion Value</th>
                                        <th>Conversion Unit ID</th>
                                        <th>Base Conversion</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($units as $item)
                                        <tr>
                                            <td>{{ $item->unit_name }}</td>
                                            <td>{{ $item->symbol }}</td>
                                            <td>{{ $item->std_name }}</td>
                                            <td>{{ $item->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $item->is_base_unit ? 'Yes' : 'No' }}</td>
                                            <td>{{ $item->conversion_value }}</td>
                                            <td>
                                                @if ($item->conversion_unit_id)
                                                    {{ $item->conversion_unit_id }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $item->is_base_conversion ? 'Yes' : 'No' }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center">
                                                {{-- Display status as Active or Inactive --}}
                                                {{ $item->status ? 'Active' : 'Inactive' }}
                                            </td>
                                            {{-- Actions --}}
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    Edit
                                                </button>
                                                {{-- Delete button --}}

                                                <form action="{{ route('admin.units.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this unit?')">Delete</button>
                                                </form>
                                            </td>



                                        </tr>
                                        {{-- crate a modal for editing unit --}}
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit
                                                            Unit</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.units.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="mb-3">
                                                                <label for="unit_name" class="form-label">Unit Name</label>
                                                                <input type="text" class="form-control" id="unit_name"
                                                                    name="unit_name" value="{{ $item->unit_name }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="symbol" class="form-label">Symbol</label>
                                                                <input type="text" class="form-control" id="symbol"
                                                                    name="symbol" value="{{ $item->symbol }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="std_name" class="form-label">Standard
                                                                    Name</label>
                                                                <select name="std_name" id="std_name"
                                                                    class="form-select">
                                                                    <option value="">Select Standard Name</option>
                                                                    <option value="length"
                                                                        {{ $item->std_name == 'length' ? 'selected' : '' }}>Length</option>
                                                                    <option value="weight"
                                                                        {{ $item->std_name == 'weight' ? 'selected' : '' }}>Weight</option>
                                                                    <option value="volume"
                                                                        {{ $item->std_name == 'volume' ? 'selected' : '' }}>Volume</option>
                                                                    <option value="currency"
                                                                        {{ $item->std_name == 'currency' ? 'selected' : '' }}>Currency</option>
                                                                    <option value="time"
                                                                        {{ $item->std_name == 'time' ? 'selected' : '' }}>Time</option>
                                                                    <option value="quantity"
                                                                        {{ $item->std_name == 'quantity' ? 'selected' : '' }}>Quantity</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="is_active" class="form-label">Active
                                                                    Status</label>
                                                                <select class="form-select" id="is_active" name="is_active">
                                                                    <option value="1"
                                                                        {{ $item->is_active ? 'selected' : '' }}>Active
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$item->is_active ? 'selected' : '' }}>Inactive
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="is_base_unit" class="form-label">Base
                                                                    Unit</label>
                                                                <select class="form-select" id="is_base_unit"
                                                                    name="is_base_unit">
                                                                    <option value="1"
                                                                        {{ $item->is_base_unit ? 'selected' : '' }}>Yes
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$item->is_base_unit ? 'selected' : '' }}>No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="conversion_value" class="form-label">Conversion
                                                                    Value</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="conversion_value" name="conversion_value"
                                                                    value="{{ $item->conversion_value }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="conversion_unit_id"
                                                                    class="form-label">Conversion Unit ID</label>
                                                                <select name="conversion_unit_id"
                                                                    id="conversion_unit_id" class="form-select">
                                                                    <option value="">Select Conversion Unit</option>
                                                                    @foreach ($units as $unit)
                                                                        <option value="{{ $unit->id }}"
                                                                            {{ $item->conversion_unit_id == $unit->id ? 'selected' : '' }}>
                                                                            {{ $unit->unit_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="is_base_conversion" class="form-label">Base
                                                                    Conversion</label>
                                                                <select class="form-select" id="is_base_conversion"
                                                                    name="is_base_conversion">
                                                                    <option value="1"
                                                                        {{ $item->is_base_conversion ? 'selected' : '' }}>
                                                                        Yes</option>
                                                                    <option value="0"
                                                                        {{ !$item->is_base_conversion ? 'selected' : '' }}>
                                                                        No</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description"
                                                                    class="form-label">Description</label>
                                                                <textarea class="form-control" id="description" name="description" rows="3">{{ $item->description }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Unit</button>
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
                            <h5 class="card-title">Add New Unit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.units.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="unit_name" class="form-label">Unit Name</label>
                                    <input type="text" class="form-control" id="unit_name" name="unit_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="symbol" class="form-label">Symbol</label>
                                    <input type="text" class="form-control" id="symbol" name="symbol" required>
                                </div>
                                <div class="mb-3">
                                    <label for="std_name" class="form-label">Standard Name</label>
                                    <select name="std_name" id="std_name" class="form-select">
                                        <option value="">Select Standard Name</option>
                                        <option value="length">Length</option>
                                        <option value="weight">Weight</option>
                                        <option value="volume">Volume</option>
                                        <option value="currency">Currency</option>
                                        <option value="time">Time</option>
                                        <option value="quantity">Quantity</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Active Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="is_base_unit" class="form-label">Base Unit</label>
                                    <select class="form-select" id="is_base_unit" name="is_base_unit">
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="conversion_value" class="form-label">Conversion Value</label>
                                    <input type="number" step="0.01" class="form-control" id="conversion_value"
                                        name="conversion_value" value="0.00" required>
                                </div>
                                <div class="mb-3">
                                    <label for="conversion_unit_id" class="form-label">Conversion Unit ID</label>
                                    <select name="conversion_unit_id" id="conversion_unit_id" class="form-select">
                                        <option value="">Select Conversion Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="is_base_conversion" class="form-label">Base Conversion</label>
                                    <select class="form-select" id="is_base_conversion" name="is_base_conversion">
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
