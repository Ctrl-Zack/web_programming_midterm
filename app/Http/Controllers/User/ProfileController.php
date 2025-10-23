<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        return view('user.profile', compact('user', 'member'));
    }

    public function edit()
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        return view('user.profile_edit', compact('user', 'member'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users_cred,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if ($member) {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');

                if ($member->profile_picture && Storage::disk('public')->exists($member->profile_picture)) {
                    Storage::disk('public')->delete($member->profile_picture);
                }

                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('profile_pictures', $filename, 'public');
                $member->profile_picture = $filename;
            }

            $member->address = $validated['address'] ?? $member->address;
            $member->phone = $validated['phone'] ?? $member->phone;
            $member->save();
        }

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}