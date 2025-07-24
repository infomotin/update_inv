<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WareHouse;

class WareHouseController extends Controller
{
    //AdminWareHouseView
    public function AdminWareHouseView(){
        $warehouse = WareHouse::all();
        return view('admin.warehouse.index',compact('warehouse'));
    }
    //AdminWareHouseStore
    public function AdminWareHouseStore(Request $request){
            // $table->string('name')->unique();
            // $table->string('address1');
            // $table->string('address2')->nullable();
            // $table->string('city');
            // $table->string('state');
            // $table->string('zip_code');
            // $table->string('country');
            // $table->string('phone')->nullable();
            // $table->string('email')->nullable();
            // $table->text('description')->nullable();
        // dd($request->all());
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/warehouses'), $filename);
            $request->merge(['logo' => $filename]);
            $request->merge(['warehouse_code' => 'WH'.time()]); // Assuming you want to use the same file for banner_image
        }
        // if ($request->hasFile('banner_image')) {
        //     $file = $request->file('banner_image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('upload/warehouses'), $filename);
        //     $request->merge(['banner_image' => $filename]);
        // }
        WareHouse::create($request->all());
        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse created successfully.');
    }
    //AdminWareHouseUpdate
    public function AdminWareHouseUpdate(Request $request, $id){
        $warehouse = WareHouse::findOrFail($id);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/warehouses'), $filename);
            $warehouse->logo = $filename;
        }
        // if ($request->hasFile('banner_image')) {
        //     $file = $request->file('banner_image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('upload/warehouses'), $filename);
        //     $warehouse->banner_image = $filename;
        // }
        $warehouse->update($request->except(['logo', 'banner_image']));
        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse updated successfully.');
    }
    //AdminWareHouseDestroy
    public function AdminWareHouseDestroy($id){
        $warehouse = WareHouse::findOrFail($id);
        if ($warehouse->logo && file_exists(public_path($warehouse->logo))) {
            unlink(public_path($warehouse->logo));
        }
        // if ($warehouse->banner_image && file_exists(public_path($warehouse->banner_image))) {
        //     unlink(public_path($warehouse->banner_image));
        // }
        $warehouse->delete();
        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
