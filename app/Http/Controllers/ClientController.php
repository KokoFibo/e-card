<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function edit()
    {


        $user = Auth::user();
        return inertia('EditProfile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'link_id' => 'required|unique:users,link_id,' . $user->id,
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'industry' => 'nullable|string|max:255',
            'tag_line' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'LinkedIn' => 'nullable|string|max:255',
            'Facebook' => 'nullable|string|max:255',
            'Instagram' => 'nullable|string|max:255',
            'Youtube' => 'nullable|string|max:255',
            'Whatsapp' => 'nullable|string|max:255',
            'Line' => 'nullable|string|max:255',
            'Tiktok' => 'nullable|string|max:255',
        ]);



        if ($request->hasFile('foto_profile')) {
            // Delete old profile picture if it exists
            if ($user->foto_profile) {
                Storage::disk('public')->delete($user->foto_profile);
            }

            // Store the new profile picture
            $path = $request->file('foto_profile')->store('foto_profiles', 'public');
            $validated['foto_profile'] = $path;
        }

        // Upload logo perusahaan jika ada
        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $validated['company_logo'] = $path;
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate password dari nama tanpa spasi
        $password = strtolower(str_replace(' ', '-', $validated['name']));
        $link_id = strtolower(str_replace(' ', '-', $validated['name'])) . '-' . Carbon::now()->format('dmY');
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($password), // Hash password sebelum menyimpan
            'link_id' => $link_id, // Hash password sebelum menyimpan
        ]);

        return redirect()->back()->with('success', 'Client data submitted successfully!');
    }
}
