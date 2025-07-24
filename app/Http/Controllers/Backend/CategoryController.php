<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Assuming you have a Category model

class CategoryController extends Controller
{
    //AdminCategoryView
    public function AdminCategoryView()
    {
            // $table->string('name')->unique();
            // $table->string('slug')->unique();
            // $table->string('image')->nullable();
            // $table->text('description')->nullable();
            // $table->boolean('status')->default(true); // true for active, false for inactive
        // Logic to retrieve and display categories
        $categories = Category::all(); // Fetch all categories from the database
        return view('admin.category.index', compact('categories'));
        // return view('admin.category.index');
    }
    //AdminCategoryStore
    public function AdminCategoryStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Create a new category
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');

        // Handle the image upload if an image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/categories'), $imageName);
            $category->image = 'upload/categories/' . $imageName; // Save the image path
        }

        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->save();
        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    //AdminCategoryUpdate
    public function AdminCategoryUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update the category
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');

        // Handle the image upload if an image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/categories'), $imageName);
            $category->image = 'upload/categories/' . $imageName; // Save the image path
        }

        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->save();
        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    //AdminCategoryDestroy
    public function AdminCategoryDestroy($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
        // Check if the category has an image and delete it from storage
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image)); // Delete the image file
        }
        // Delete the category
        $category->delete();
        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
