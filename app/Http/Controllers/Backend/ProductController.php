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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

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
        $products = Product::with(['category', 'brand', 'warehouse', 'supplier', 'unit'])->get();
        $categories = Category::all();
        $brands = Brand::all();
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.product.index', compact('products', 'categories', 'brands', 'warehouses', 'suppliers', 'units', 'sizes', 'colors'));
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
        $products = Product::with('category', 'brand', 'warehouse', 'supplier', 'unit')->get(); // send the data to the view
        return view('admin.product.create', compact('categories', 'brands', 'warehouses', 'suppliers', 'units', 'products', 'sizes', 'colors'));
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
        if ($validatedData == null) {
            return redirect()->route('admin.products.create')->with('error', 'Product not created successfully.');
        }
        DB::beginTransaction();
        try {
            $product = Product::create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.create')->with('error', 'Product not created successfully.');
        }

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
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'warehouses', 'suppliers', 'units'));
    }
    //AdminProductDetailsStore
    public function AdminProductDetailsStore(Request $request, $id)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
        // dd($product);
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'warehouse_id' => 'required|exists:ware_houses,id',
        ]);
        if ($validatedData == null) {
            return redirect()->route('admin.products.index')->with('error', 'Product not updated successfully.');
        }
        DB::beginTransaction();
        try {
            $product->details()->updateOrCreate(['product_id' => $id], $validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Product not updated successfully.');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    //AdminProductVariantStore
    public function AdminProductVariantStore(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        dd($request->all());
        // $validatedData = $request->validate([
        //     'size_id' => 'required|exists:sizes,id',
        //     'color_id' => 'required|exists:colors,id',
        // ]);
        // if ($validatedData == null) {
        //     return redirect()->route('admin.products.index')->with('error', 'Product not updated successfully.');
        // }
        DB::beginTransaction();
        try {
            //  $table->id();
            // $table->unsignedBigInteger('product_id');
            // $table->string('name')->nullable();
            // $table->string('sku')->unique()->nullable();
            // $table->decimal('price', 8, 2)->nullable();
            // $table->decimal('discount', 8, 2)->nullable();
            // $table->integer('quantity')->default(0);
            // $table->boolean('status')->default(true);
            // $table->boolean('featured')->default(false);
            // //size and color and barcode and image 
            // $table->unsignedBigInteger('size_id')->nullable();
            // $table->unsignedBigInteger('color_id')->nullable();
            // $table->string('barcode')->nullable();
            // $table->json('image')->nullable();
            $count = count($request->price);
            //  dd($count);
            $productVariant = new ProductVariant();
            for ($i = 0; $i < $count; $i++) {
                $productVariant->product_id = $id;
                $productVariant->name = $request->name[$i];
                $productVariant->sku = Str::replace(' ', '', $request->name[$i]);
                $productVariant->price = $request->price[$i];
                $productVariant->discount = 0;
                $productVariant->quantity = $request->quantity[$i];
                $productVariant->status = true;
                $productVariant->featured = false;
                $productVariant->size_id = $request->size_id[$i];
                $productVariant->color_id = $request->color_id[$i];
                $productVariant->save();
            }
            //now change Product Table status to Active
            $product->update([
                'active' => 'Active',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Product not updated successfully.');
        }
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
}
