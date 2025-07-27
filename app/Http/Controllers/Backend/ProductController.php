<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model
use App\Models\Brand;
use App\Models\Category;
use App\Models\WareHouse;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Size;
use App\Models\Color;

class ProductController extends Controller
{
    //          $table->id();
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

    public function AdminProductView()
    {
        $products = Product::with(['category', 'brand', 'warehouse', 'supplier', 'unit', 'size', 'color'])->get();
        return view('admin.product.index', compact('products'));
    }
    //AdminProductCreate
    public function AdminProductCreate()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        // Assuming you have these models and they are correctly set up
        $products = Product::with('category', 'brand', 'warehouse', 'supplier', 'unit', 'size', 'color')->get(); // send the data to the view
        return view('admin.product.create', compact('categories', 'brands', 'warehouses', 'suppliers', 'units', 'sizes', 'colors', 'products'));
    }

    //AdminProductStore
    public function AdminProductStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'unit_id' => 'required|exists:units,id',

        ]);
        if($validatedData == null){
            return redirect()->route('admin.products.create')->with('error', 'Product not created successfully.');
        }

        Product::create($validatedData);

        return redirect()->route('admin.products.create')->with('success', 'Product created successfully.');
    }
    // AdminProductEdit
    public function AdminProductEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'warehouses', 'suppliers', 'units', 'sizes', 'colors'));
    }

}
