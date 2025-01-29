<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user/{link_id}', function ($link_id) {
    $user = User::where('link_id', $link_id)->first();

    if (!$user) {
        abort(404, 'User not found');
    }

    return response()->json($user);

    // In your Laravel API
    // return response()->json([
    //     'name' => $user->name,
    //     'email' => $user->email,
    //     'created_at' => $user->created_at,
    //     'profile_photo' => $user->foto_profile, // Add this line
    // ]);
});
