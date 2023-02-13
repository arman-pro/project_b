<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() 
    {
        return view("admin.index");
    }

    public function index() 
    {
        $admins = Admin::all();
        return view("admin.admin.index", compact("admins"));
    }

    public function clients() 
    {
        $users = User::withCount(['orders'])->get();
        return view('admin.clients.index', compact('users'));
    }

    public function create_login()
    {
        return view('admin.auth.login');
    }

    public function store_login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin = Admin::whereEmail($request->email)->first();
        if(!($admin && Hash::check($request->password, $admin->password))) {
            return redirect()->back()->with('error', 'Your crediantial doesn\'t match in our Record!');
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.index')->with('message', "Welcome to Admin Panel!");
    }
}
