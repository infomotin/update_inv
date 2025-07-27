@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Create Product</h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                            <li class="breadcrumb-item active">Create Product</li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- Model description Header  --}}
            {{-- //          $table->id();
    //         $table->string('name')->nullable();
    //         $table->string('code')->unique()->nullable();
    //         $table->text('description')->nullable();
    //         $table->string('sku')->unique()->nullable();
    //         $table->json('image')->nullable();
    //         $table->decimal('price', 8, 2)->nullable();
    //         $table->decimal('discount', 8, 2)->nullable();
    //         $table->unsignedBigInteger('category_id')->nullable();
    //         $table->unsignedBigInteger('brand_id')->nullable();
    //         $table->unsignedBigInteger('warehouse_id')->nullable();
    //         $table->unsignedBigInteger('supplier_id')->nullable();
    //         $table->unsignedBigInteger('unit_id')->nullable();
    //         $table->unsignedBigInteger('size_id')->nullable();
    //         $table->unsignedBigInteger('color_id')->nullable();
    //         $table->integer('quantity')->default(0);
    //         $table->boolean('status')->default(true);
    //         $table->boolean('featured')->default(false);
    //         $table->string('active')->default('Pending');


    //         // Foreign key constraints
    //         $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    //         $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
    //         $table->foreign('warehouse_id')->references('id')->on('ware_houses')->onDelete('cascade');
    //         $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
    //         $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
    //         $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
    //         $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
 --}}


            {{--  end of Model description Header  --}}


            <div class="container-xxl">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="code" class="form-label">Product Code</label>
                                    <input type="text" class="form-control" id="code" name="code" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select class="form-select" id="brand_id" name="brand_id" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select" id="unit_id" name="unit_id" required>
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </form>
                    </div>
                </div>
                {{-- parent table  --}}
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Unit</th>
                                    <th>Complete</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->brand_name }}</td>
                                        <td>{{ $product->unit->unit_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productDetailsModal{{ $product->id }}">Add Details</a>
                                        </td>
                                        <td>
                                            <a href="#"
                                                class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    {{-- show details modal here --}}
                                    <div class="modal fade" id="productDetailsModal{{ $product->id }}" tabindex="-1" aria-labelledby="productDetailsModalLabel{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="productDetailsModalLabel{{ $product->id }}">Add Product Details</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- <form action="{{ route('admin.product.store', $product->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                        <form action="#" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" hidden name="product_id" value="{{ $product->id }}">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Supplier </label>
                                                            <select class="form-select" name="supplier_id" id="supplier_id">
                                                                <option value="">Select Supplier</option>
                                                                @foreach ($suppliers as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Warehouse</label>
                                                            <select class="form-select" name="warehouse_id" id="warehouse_id">
                                                                <option value="">Select Warehouse</option>
                                                                @foreach ($warehouses as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                       {{-- Select Colour then Select Size then Add Stock --}}
                                                       









                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- show edit modal here --}}
                                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editProductModalLabel{{ $product->id }}">Edit Product</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of edit modal --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- end of parent table --}}


            </div>

        </div>
    </div>


@endsection
