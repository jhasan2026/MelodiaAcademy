<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Get profile current log in user
    protected function getProfile()
    {
        $user = Auth::user();
        $profile = null;

        if ($user->role === 'student') {
            $profile = $user->student;
        }
        elseif ($user->role === 'instructor') {
            $profile = $user->instructor;
        }
        elseif ($user->role === 'admin') {
            $profile = $user->admin;
        }

        return [$user, $profile];
    }

    public function show()
    {
        [$user, $profile] = $this->getProfile();
        return view('profile.show', compact('user', 'profile'));
    }

    public function edit()
    {
        [$user, $profile] = $this->getProfile();
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        [$user, $profile] = $this->getProfile();

        // Validate general user fields
        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
        ]);

        // Validate & update role-specific fields
        if ($user->role === 'student') {
            $request->validate([
                'gender'        => 'nullable|in:male,female',
                'date_of_birth' => 'nullable|date',
            ]);

            $profile->update([
                'gender'        => $request->input('gender') ?: null,           // convert empty string to null
                'date_of_birth' => $request->input('date_of_birth') ?: null,    // convert empty string to null
            ]);
        } elseif ($user->role === 'instructor') {
            $request->validate([
                'bio'             => 'nullable|string',
                'specialization'  => 'nullable|string',
                'experience_years'=> 'nullable|integer|min:0',
            ]);

            $profile->update([
                'bio'             => $request->input('bio'),
                'specialization'  => $request->input('specialization'),
                'experience_years'=> $request->input('experience_years'),
            ]);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/profiles'), $filename);

            $profile->update([
                'profile_pic' => 'storage/profiles/'.$filename
            ]);
        } elseif (!$profile->profile_pic) {
            // Set default if no profile picture exists
            $profile->update([
                'profile_pic' => 'images/default.png'
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

}
