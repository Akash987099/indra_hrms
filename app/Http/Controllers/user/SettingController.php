<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user')->user();
        return view('employee.setting.index', compact('user'));
    }

    // ✅ CHANGE PASSWORD
    public function update(Request $request)
    {
        $user = Auth::guard('user')->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        // check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['success' => true]);
    }

    // ✅ SAVE NOTIFICATION SETTINGS
    public function store(Request $request)
    {
        $user = Auth::guard('user')->user();

        $user->update([
            'email_notification' => $request->email_notification ?? 0,
            'leave_notification' => $request->leave_notification ?? 0,
            'payroll_notification' => $request->payroll_notification ?? 0,
            'training_notification' => $request->training_notification ?? 0,
        ]);

        return response()->json(['success' => true]);
    }
}