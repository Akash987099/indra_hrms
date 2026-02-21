<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // ✅ VIEW
    public function index()
    {
        $user = Auth::guard('user')->user();

        return view('employee.profile.index', compact('user'));
    }

    // ✅ UPDATE PROFILE
    public function update(Request $request)
    {
        $user = Auth::guard('user')->user();

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'      => 'required',
        ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address'
        ]));

        return response()->json(['success' => true]);
    }

    // ✅ PROFILE PHOTO
    public function uploadPhoto(Request $request)
    {
        $user = Auth::guard('user')->user();

        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);

        $folder = public_path('profile');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true, true);
        }

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move($folder, $filename);

        $user->update([
            'profile_photo' => 'profile/' . $filename
        ]);

        return response()->json(['success' => true]);
    }
}
