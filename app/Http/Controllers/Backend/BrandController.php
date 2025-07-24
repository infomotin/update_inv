<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    //AdminBrandView
    public function AdminBrandView()
    {

        // using Pagination for better performance
        $brands = Brand::paginate(10);
        return view('admin.brand.index', compact('brands'));
    }
    //AdminBrandCreate
    public function AdminBrandCreate()
    {
        return view('admin.brand.create');
    }
    //AdminBrandStore
    public function AdminBrandStore(Request $request)
            // $table->string('brand_name')->unique();
            // $table->string('brand_slug')->unique();
            // $table->string('brand_image')->nullable();
            // $table->text('brand_description')->nullable();
            // $table->boolean('status')->default(true); // Assuming status is a boolean for active
            // $table->unsignedBigInteger('created_by')->nullable();
            // $table->unsignedBigInteger('updated_by')->nullable();
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            // $table->softDeletes(); // For soft delete functionality
            // $table->string('meta_title')->nullable();
            // $table->string('meta_keywords')->nullable();
            // $table->text('meta_description')->nullable();
            // $table->string('meta_image')->nullable();
            // $table->string('meta_slug')->nullable();
            // $table->string('meta_author')->nullable();
            // $table->string('meta_robots')->nullable();
            // $table->string('meta_canonical')->nullable();
            // $table->string('meta_viewport')->nullable();
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_description' => 'nullable|string',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->brand_name)));
        $brand->brand_description = $request->brand_description;

        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brands'), $imageName);
            $brand->brand_image = 'upload/brands/' . $imageName;
        }

        // Assuming the user ID is available in the session
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
        $brand->created_by = $userId;
        $brand->updated_by = $userId;
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');

    }
    //AdminBrandUpdate
    public function AdminBrandUpdate(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'brand_name' => 'required|max:255|unique:brands,brand_name,' . $id,
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_description' => 'nullable|string',
            'old_image' => 'nullable|string', // Validate old image path
        ]);
        $brand = Brand::findOrFail($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->brand_name)));
        $brand->brand_description = $request->brand_description;
        $brand->status = $request->status; // Use old image if no new image is uploaded
        // Check if a new image is uploaded
        if ($request->hasFile('brand_image')) {
            // Delete the old image if it exists
            if ($brand->brand_image && file_exists(public_path($brand->brand_image))) {
                unlink(public_path($brand->brand_image));
            }
            // Store the new image
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/brands'), $imageName);
            $brand->brand_image = 'upload/brands/' . $imageName;
        } else {
            // If no new image is uploaded, keep the old image
            $brand->brand_image = $request->old_image;
        }

        // Assuming the user ID is available in the session
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
        $brand->updated_by = $userId;
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }
    //AdminBrandDestroy
    public function AdminBrandDestroy($id)
    {
        $brand = Brand::findOrFail($id);
        // Delete the brand image if it exists
        if ($brand->brand_image && file_exists(public_path($brand->brand_image))) {
            unlink(public_path($brand->brand_image));
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }

}
