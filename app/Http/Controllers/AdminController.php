<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AdminController extends Controller
{
    //AdminProfile
    public function AdminProfile()
    {
        // dd('Admin Profile');
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile', compact('adminData'));
    }
    //AdminProfileUpdate
    public function AdminProfileUpdate(Request $request): RedirectResponse
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'username' => 'nullable|string|max:50',
            'old_image' => 'nullable|string|max:255',
        ]);
        // Update the admin profile
        if ($request->id == '') {
            return redirect()->back()->withErrors(['error' => 'Invalid Admin ID']);
        }
        $id = Auth::user()->id;
        $adminData = User::find($id);
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->address = $request->address;
        $adminData->phone = $request->phone;
        if ($request->username) {
            $adminData->username = $request->username;
        }else {

            $adminData->username = $adminData->username = str_replace(' ', '_', $request->name);
        }
        // Check if the user is trying to update the avatar
        // Handle the avatar image upload
        //if on old image is provided, use it
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $adminData->avatar = 'upload/admin_images/' . $filename;
        } else {
            $adminData->avatar = $request->old_image; // Use the old image if no new image is uploaded
        }
        // Save the updated admin data
        $adminData->save();
        //if the update is successful, redirect with a success message else redirect back with an error
        if (!$adminData) {
            return redirect()->back()->withErrors(['error' => 'Profile Update Failed']);
        }
        // Redirect with success message
        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.profile')->with($notification);
        // return redirect()->back();
    }
    //Adminlogout
    public function Adminlogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
