<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    // AdminSupplierView
    public function AdminSupplierView()
    {
            // $table->string('name');
            // $table->string('address1');
            // $table->string('address2')->nullable();
            // $table->string('phone')->nullable();
            // $table->string('email')->nullable();
            // $table->string('category')->nullable();
            // $table->text('description')->nullable();
            // $table->string('website')->nullable();
            // $table->string('contact_person')->nullable();
            // $table->string('contact_person_phone')->nullable();
            // $table->string('city');
            // $table->string('state');
            // $table->string('country');
            // $table->boolean('status')->default(true);
            // $table->string('brand')->nullable();
            // $table->string('logo')->nullable();
            // $table->string('banner_image')->nullable();
            // $table->string('supplier_code')->unique(); // Unique code
            // $table->string('tax_id')->nullable(); // Optional tax ID
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }
    //AdminSupplierStore
    public function AdminSupplierStore(Request $request){
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/suppliers'), $filename);
            $request->merge(['logo' => $filename]);
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/suppliers'), $filename);
            $request->merge(['banner_image' => $filename]);
        }
        $request->merge(['supplier_code' => 'SUP'.time()]); // Assuming you want to use the same file for supplier_code
        Supplier::create($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }
    //AdminSupplierUpdate
    public function AdminSupplierUpdate(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/suppliers'), $filename);
            $request->merge(['logo' => $filename]);
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/suppliers'), $filename);
            $request->merge(['banner_image' => $filename]);
        }
        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }
    //AdminSupplierDestroy
    public function AdminSupplierDestroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        if ($supplier->logo) {
            $logoPath = public_path('upload/suppliers/' . $supplier->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);  // Delete the logo file
            }
        }
        if ($supplier->banner_image) {
            $bannerPath = public_path('upload/suppliers/' . $supplier->banner_image);
            if (file_exists($bannerPath)) {
                unlink($bannerPath);  // Delete the banner image file
            }
        }
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }

}
