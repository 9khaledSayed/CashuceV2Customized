<?php

namespace App\Http\Controllers\Dashboard;

use anlutro\LaravelSettings\Facade as Setting;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Rules\EqualToCurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accountInfo()
    {
        $user = auth()->user();
        return view('dashboard.myProfile.account_info', compact('user'));
    }

    public function updateAccountInfo(Request $request)
    {
        $user = auth()->user();
        $user->update($request->validate([
            'fname_ar' => 'required|string|max:191',
            'lname_ar' => 'required|string|max:191',
            'fname_en' => 'required|string|max:191',
            'lname_en' => 'required|string|max:191',
            'email' => 'sometimes|required|email|unique:employees,email,' . $user->id,
        ]));

        return redirect(route('dashboard.myProfile.account_info'))->with('success', 'true');
    }

    public function changePasswordForm()
    {
        $user = auth()->user();
        return view('dashboard.myProfile.change_password', compact('user'));
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'current_password' => ['required', 'string', new EqualToCurrentPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $user->update(['password' => $request->password ]);
        return redirect(route('dashboard.myProfile.change_password'))->with('success', 'true');
    }
}
