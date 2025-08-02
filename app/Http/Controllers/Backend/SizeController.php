<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size; // Assuming you have a Size model
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    // AdminSizeView
    public function AdminSizeView()
    {
            // /$table->string('size_name')->unique();
            // $table->string('description')->nullable();
            // $table->boolean('is_active')->default(true);
            // $table->double('size_rank', 8, 2)->default(0.00); 
        $sizes = Size::orderBy('size_rank', 'asc')->get(); // Fetch all sizes from the database
        return view('admin.sizes.index', compact('sizes'));
    }
    //AdminSizeStore
    public function AdminSizeStore(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'size_name' => 'required|unique:sizes|max:255',
        //     'size_rank' => 'required|numeric|min:0',
        // ]);
        DB::beginTransaction();
        try { 
            // size rank auto increment valus 
            $size_rank = Size::max('size_rank');
            $size_rank = $size_rank + 1;
            

            $size = Size::create([
                'size_name' => $request->size_name,
                'size_rank' => $size_rank,
                'is_active' => 1,
                'description' => $request->description,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.sizes.index')->with('error', 'Size not created successfully.');
        }
        // Redirect back to the sizes index with a success message
        return redirect()->route('admin.sizes.index')->with('success', 'Size created successfully.');
    }
    //AdminSizeEdit
    public function AdminSizeEdit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.sizes.edit', compact('size'));
    }
    // AdminSizeUpdate
    public function AdminSizeUpdate(Request $request, $id)
    {
        $size = Size::findOrFail($id);
        $size->update([
            'size_name' => $request->size_name,
            'size_rank' => $request->size_rank,
            'is_active' => 1,
            'description' => $request->description,
        ]);
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
