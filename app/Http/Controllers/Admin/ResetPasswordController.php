<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordChangeMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function create()
    {
        return view('admin.auth.forgot');
    }

    public function change()
    {
        return view('admin.auth.change');
    }

    public function changeStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'temp_password' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if(!Hash::check($request->temp_password, $admin->password)) {
            return redirect()->back()->with('error', 'Temporary password is worng!');
        }
        $admin->password = Hash::make($request->password);
        $admin->save();
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
        ]);

        $admin = Admin::where('email', $request->email)->first();
        $temp = substr(rand(), 0, 8);
        $admin->password = Hash::make($temp);
        $admin->save();
        Mail::to($request->email)->send(new AdminPasswordChangeMail(['temp' => $temp, 'email' => $request->email]));
        return redirect()->back()->with('status', 'Temporary password send in email');
        
    }
}
