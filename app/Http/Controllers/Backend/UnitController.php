<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit; // Assuming you have a Unit model

class UnitController extends Controller
{
    //AdminUnitView
    public function AdminUnitView()
    {
        $units = Unit::all();
        return view('admin.unit.index', compact('units'));

    }
    //AdminUnitStore
    public function AdminUnitStore(Request $request)
    {
        //     $table->string('unit_name')->unique();
        //     $table->string('symbol')->unique();
        //     $table->string('std_name')->nullable();
        //     $table->boolean('is_active')->default(true);
        //     $table->boolean('is_base_unit')->default(false);
        //     $table->double('conversion_value', 8, 2)->default(0.00);
        //     $table->string('conversion_unit_id')->nullable();
        //     $table->boolean('is_base_conversion')->default(false);
        //     $table->string('description')->nullable();
        $request->validate([
            'unit_name' => 'required|unique:units',
            'symbol' => 'required|unique:units',
        ]);

        Unit::create([
            'unit_name' => $request->unit_name,
            'symbol' => $request->symbol,
            'std_name' => $request->std_name,
            'is_active' => $request->is_active ?? true,
            'is_base_unit' => $request->is_base_unit ?? false,
            'conversion_value' => $request->conversion_value ?? 0.00,
            'conversion_unit_id' => $request->conversion_unit_id ?? null,
            'is_base_conversion' => $request->is_base_conversion ?? false,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.units.index')->with('success', 'Unit created successfully.');
    }
    //AdminUnitUpdate
    public function AdminUnitUpdate(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return redirect()->route('admin.units.index')->with('success', 'Unit updated successfully.');
    }
}
