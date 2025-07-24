<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //AdminCustomerView
    public function AdminCustomerView()
    {
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->string('type')->default('wacking'); // regular, premium, guest
            // $table->string('category')->default('cradit'); // regular, premium, guest
            // $table->string('phone')->nullable();
            // $table->string('address')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('zip')->nullable();
            // $table->string('country')->nullable();
            // $table->string('social_media_links')->nullable();
            // $table->string('profile_picture')->nullable();
            // $table->string('status')->default('active'); // active, inactive, banned
            // $table->date('DOB')->nullable(); // Date of Birth
        // Logic to retrieve and display customers
        $customers = Customer::all();
        return view('admin.customer.index', compact('customers'));
    }
    //AdminCustomerStore
    public function AdminCustomerStore(Request $request)
    {
        // Validate and store customer data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:customers,email',
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     // Add other validation rules as needed
        // ]);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/customers'), $imageName);
        } else {
            $imageName = null; // or set a default image
        }
        $customerData = $request->all();
        $customerData['profile_picture'] = $imageName;
        Customer::create($customerData);
        // Redirect or return response
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }
    //AdminCustomerUpdate
    public function AdminCustomerUpdate(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        // Validate and update customer data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:customers,email,' . $id,
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     // Add other validation rules as needed
        // ]);
        $customerData = $request->all();
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/customers'), $imageName);
            $customerData['profile_picture'] = $imageName;
        }
        $customer->update($customerData);
        // Redirect or return response
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }
    //AdminCustomerDestroy
    public function AdminCustomerDestroy($id)
    {
        $customer = Customer::findOrFail($id);
        //Profile Picture Deletion
        if ($customer->profile_picture) {
            unlink(public_path('upload/customers/' . $customer->profile_picture));
        }
        $customer->delete();
        // Redirect or return response
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
