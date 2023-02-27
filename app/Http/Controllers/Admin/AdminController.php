<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function __construct()
    {
        // user permission check
        $this->middleware('permission:admin-index,admin')->only(['index', 'show']);
        $this->middleware('permission:admin-create,admin')->only(['create', 'store']);
        $this->middleware('permission:admin-update,admin')->only(['edit', 'update']);
        $this->middleware('permission:admin-destroy,admin')->only(['destroy']);
    }

    public function dashboard() 
    {
        $total_orders = Order::count();
        $total_category = Category::count();
        $total_blogs = Blog::count();
        $total_clients = User::count();
        $total_admins = Admin::count();
        return view("admin.index", compact("total_category", "total_orders", "total_blogs", "total_clients", "total_admins"));
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view("admin.profile", compact("admin"));
    }

    public function index() 
    {
        $admins = Admin::all();
        return view("admin.admin.index", compact("admins"));
    }

    public function create()
    {
        $roles = Role::whereGuardName("admin")->get();
        return view('admin.admin.create', compact("roles"));
    }

    public function store(AdminRequest $request) 
    {
        $data = $request->all();
        if(!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else {
            unset($data['password']);
        }
        $admin = Admin::create($data);
        $role = Role::find($request->role);
        $admin->assignRole($role->name);
        return redirect()->route("admin.users.index")->with('message', "Admin create successfull!");
    }

    public function edit($user)
    {
        $admin = Admin::findOrFail($user);
        $roles = Role::whereGuardName("admin")->get();
        return view("admin.admin.edit", compact('admin', 'roles'));
    }

    public function update(AdminRequest $request)
    {
        $data = $request->all();
        if(!is_null($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else {
            unset($data['password']);
        }
        $admin = Admin::findOrFail($request->user);
        $admin->update($data);        
        if($request->role) {
            if($admin->getRoleNames()->isNotEmpty()) { 
                $admin->removeRole($admin->getRoleNames()[0]);
            } 
            $role = Role::find($request->role);
            $admin->assignRole($role->name);
        }       
        if($request->redirect) {
            return redirect()->route("admin.index")->with("message", "Admin update successfull!");
        }
        return redirect()->route("admin.users.index")->with("message", "Admin update successfull!");
    }

    public function destroy(Request $request)
    {
        Admin::destroy($request->user);
        return redirect()->route("admin.users.index")->with("message", "Admin delete successfull!");
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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.create');
    }
}
