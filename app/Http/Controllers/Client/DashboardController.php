<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DashboardController extends Controller
{
    public function index()
    {
        $total_orders = Order::whereCreatedBy(Auth::id())->count();
        $pending_orders = Order::whereCreatedBy(Auth::id())->whereStatus('1')->count();
        $processing_orders = Order::whereCreatedBy(Auth::id())->whereStatus('2')->count();
        $approved_orders = Order::whereCreatedBy(Auth::id())->whereStatus('3')->count();
        $cancel_orders = Order::whereCreatedBy(Auth::id())->whereStatus('0')->count();
        $user = User::find(Auth::id());
        return view('clients.index', compact('total_orders', 'pending_orders', 'processing_orders', 'approved_orders', 'cancel_orders', 'user'));
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        return view("clients.profile", compact('user'));
    }

    /**
     * update user profile
     */
    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$request->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        $data = $request->all();
        $user = User::findOrFail(Auth::id());
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('dashboard.profile')->with('message', 'Profile update successfull!');
    }
}
