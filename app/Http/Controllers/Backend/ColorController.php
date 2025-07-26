<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Color;

class ColorController extends Controller
{
    //AdminColorView
    public function AdminColorView()
    {
        // $table->string('color_name')->unique();
        //     $table->string('hex_code')->unique()->nullable();
        //     $table->string('description')->nullable();
        //     $table->boolean('is_active')->default(true);
        //     $table->string('color_group')->default(false);
        $colors = Color::all(); // Fetch all colors from the database
        return view('admin.colors.index', compact('colors'));
    }
    //AdminColorStore
    public function AdminColorStore(Request $request)
    {
        $request->validate([
            'color_name' => 'required|unique:colors,color_name',
            'hex_code' => 'nullable|unique:colors,hex_code',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'color_group' => 'nullable|string',
        ]);
        $color = new Color();
        $color->color_name = $request->color_name;
        $color->hex_code = $request->hex_code;
        $color->description = $request->description;
        $color->is_active = $request->is_active;
        $color->color_group = $request->color_group;
        $color->save();
        return redirect()->route('admin.colors.index')->with('success', 'Color added successfully.');
    }
    // /AdminColorUpdate
    public function AdminColorUpdate(Request $request, $id)
    {
        $request->validate([
            'color_name' => 'required|unique:colors,color_name,' . $id,
            'hex_code' => 'nullable|unique:colors,hex_code,' . $id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'color_group' => 'nullable|string',
        ]);
        $color = Color::findOrFail($id);
        $color->color_name = $request->color_name;
        $color->hex_code = $request->hex_code;
        $color->description = $request->description;
        $color->is_active = $request->is_active;
        $color->color_group = $request->color_group;
        $color->save();
        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully.');
    }
    //AdminColorDestroy
    public function AdminColorDestroy($id)
    {        $color = Color::findOrFail($id);
        $color->delete();
        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully.');
    }
}
