<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size; // Assuming you have a Size model

class SizeController extends Controller
{
    // AdminSizeView
    public function AdminSizeView()
    {
            // $table->string('size_name')->unique();
            // $table->string('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->string('size_group')->default(false);
            // $table->string('unit_id')->nullable(); // Assuming you want to link sizes to units
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade'); // Foreign key constraint to units table
            // $table->string('symbol')->nullable(); // Optional symbol for size
            // $table->boolean('is_base_size')->default(false); // Indicates if this is a base size
            // $table->double('conversion_value', 8, 2)->default(0.00); // Conversion value for size
        $sizes = Size::all(); // Fetch all sizes from the database
        return view('admin.sizes.index', compact('sizes'));
    }
    //AdminSizeStore
    public function AdminSizeStore(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'size_name' => 'required|unique:sizes|max:255',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'size_group' => 'nullable|string|max:255',
            'unit_id' => 'nullable|exists:units,id',
            'symbol' => 'nullable|string|max:50',
            'is_base_size' => 'boolean',
            'conversion_value' => 'numeric|min:0',
        ]);

        Size::create($request->all());
        if ($request->has('unit_id')) {
            $size = Size::where('unit_id', $request->unit_id)->first();
            if ($size) {
                $size->update(['unit_id' => $request->unit_id]);
            }
        }
        // Redirect back to the sizes index with a success message
        return redirect()->route('admin.sizes.index')->with('success', 'Size created successfully.');
    }

    // AdminSizeUpdate
    public function AdminSizeUpdate(Request $request, $id)
    {
        $size = Size::findOrFail($id);
        $size->update($request->all());
        return redirect()->route('admin.sizes.index')->with('success', 'Size updated successfully.');
    }
    //AdminSizeDestroy
    public function AdminSizeDestroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->route('admin.sizes.index')->with('success', 'Size deleted successfully.');
    }

}
