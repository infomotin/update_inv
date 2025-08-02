@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Product</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                        <li class="breadcrumb-item active">All Products</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Product List</h5>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    {{-- $table->string('name')->nullable();
                                        $table->string('code')->unique()->nullable();
                                        $table->text('description')->nullable();
                                        $table->string('sku')->unique()->nullable();
                                        $table->json('image')->nullable();
                                        $table->decimal('price', 8, 2)->nullable();
                                        $table->decimal('discount', 8, 2)->nullable();
                                        $table->unsignedBigInteger('category_id')->nullable();
                                        $table->unsignedBigInteger('brand_id')->nullable();
                                        $table->unsignedBigInteger('warehouse_id')->nullable();
                                        $table->unsignedBigInteger('supplier_id')->nullable();
                                        $table->unsignedBigInteger('unit_id')->nullable();
                                    
                                        $table->integer('quantity')->default(0);
                                        $table->boolean('status')->default(true);
                                        $table->boolean('featured')->default(false);
                                        $table->string('active')->default('Pending');


                                        // Foreign key constraints
                                        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                                        $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
                                        $table->foreign('warehouse_id')->references('id')->on('ware_houses')->onDelete('cascade');
                                        $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
                                        $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
                                 --}}
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Warehouse</th>
                                        <th>Supplier</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Add Variant</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>

                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset($item->image->first()->image ?? 'uploads/no_image.png') }}"
                                                        alt="Product Image" width="50">
                                                @endif
                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>{{ $item->category ? $item->category->name : 'N/A' }}</td>
                                            <td>{{ $item->brand ? $item->brand->name : 'N/A' }}</td>
                                            <td>{{ $item->warehouse ? $item->warehouse->name : 'N/A' }}</td>
                                            <td>{{ $item->supplier ? $item->supplier->name : 'N/A' }}</td>
                                            <td>{{ $item->unit ? $item->unit->name : 'N/A' }}</td>

                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $item->featured ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#productDetailsModal{{ $item->id }}">Add
                                                    Details</a>
                                            </td>
                                            <td>{{ ucfirst($item->active) }}</td>
                                            <td>
                                                <!-- Add action buttons here -->
                                                <a href="#" class="btn btn-info btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Product Details Modal -->
                                        <div class="modal fade" id="productDetailsModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="productDetailsModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="productDetailsModalLabel{{ $item->id }}">Product
                                                            Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- $table->unsignedBigInteger('product_id'); -->
                                                        <!-- $table->string('name')->nullable();
                                                                        $table->string('sku')->unique()->nullable();
                                                                        $table->decimal('price', 8, 2)->nullable();
                                                                        $table->decimal('discount', 8, 2)->nullable();
                                                                        $table->integer('quantity')->default(0);
                                                                        $table->boolean('status')->default(true);
                                                                        $table->boolean('featured')->default(false);
                                                                        //size and color and barcode and image
                                                                        $table->unsignedBigInteger('size_id')->nullable();
                                                                        $table->unsignedBigInteger('color_id')->nullable();
                                                                        $table->string('barcode')->nullable();
                                                                        $table->json('image')->nullable();
                                                                        // Foreign key constraints
                                                                        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                                                                        $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
                                                                        $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade'); -->
                                                        <!-- make this modal dynamic with product id multiple variant add form with upper details table colume name  -->
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.product.variant.store', $item->id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $item->id }}">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" required>
                                                                </div>
                                                                <div class="form-group row" style="margin-top: 10px;"
                                                                    id="variantForm">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="price">Price</label>
                                                                        <input type="number" class="form-control"
                                                                            name="price[]" step="0.01" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" class="form-control"
                                                                            name="quantity[]" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="size">Size</label>
                                                                        <select class="form-control" name="size[]"
                                                                            required>
                                                                            <option value="">Select Size</option>
                                                                            @foreach ($sizes as $size)
                                                                                <option value="{{ $size->id }}">
                                                                                    {{ $size->size_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="color">Color</label>
                                                                        <select class="form-control" name="color[]"
                                                                            required>
                                                                            <option value="">Select Color</option>
                                                                            @foreach ($colors as $color)
                                                                                <option value="{{ $color->id }}">
                                                                                    {{ $color->color_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{-- //add or remove button for variant form --}}
                                                                <div class="add_item">
                                                                    <button type="button"
                                                                        class="btn btn-success addeventmore">Add
                                                                        More Variant</button>
                                                                    <button type="button"
                                                                        class="btn btn-danger removeeventmore">Remove
                                                                        Variant</button>
                                                                </div>
                                                                <div>
                                                                    <button type="submit" class="btn btn-primary">Add
                                                                        Variant</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                        </div>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Product Details Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- End Product Details Modal -->
            </div>
        </div> <!-- container-fluid -->

    </div>
    <!-- End Content-->
    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#variantForm").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>

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
