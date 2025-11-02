<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        return view('backend.pages.profile.profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
{
    // Get the currently authenticated user
    $id = $request->uid;
    $user = User::find($id);

    // Validate the incoming request
    $request->validate([
        'fName' => 'required|string|max:255',
        'lName' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image file
    ]);

    // Update the user with the provided data
    $user->fname = $request->input('fName');
    $user->lname = $request->input('lName');
    $user->phone = $request->input('phone');
    $user->email = $request->input('email');

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        // Delete old image if exists
        if ($user->image && file_exists(public_path('backend/assets/images/users/' . $user->image))) {
            unlink(public_path('backend/assets/images/users/' . $user->image));
        }

        // Upload new image
        $image->move(public_path('backend/assets/images/users'), $imageName);
        $user->image = $imageName;
    }

    // Save the updated user data
    $user->save();

    // Return success message and redirect
    toast('Profile updated successfully!', 'success');
    return Redirect::route('profile.index')->with('status', 'profile-updated');
}


    public function reset(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|max:191|min:8',
            'password' => 'required|max:191|min:8|confirmed',
            'password_confirmation' => 'required|min:8|max:191|same:password',
        ]);

        try {
            DB::beginTransaction();

            // Check if the current password matches the user's actual password
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match']);
            }

            // Update the password
            $id = $request->uid;
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();
            toast('Password updated successfully!', 'success');
            return redirect()->route('profile.index'); // Adjust the redirect route as necessary
        } catch (\Exception $e) {
            DB::rollBack();
            toast('Something went wrong!', 'error');
            return back();
        }
    }
}
