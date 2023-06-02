<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        // user permission check
        $this->middleware('permission:order-index,admin')->only(['index', 'show']);
        $this->middleware('permission:order-create,admin')->only(['create', 'store']);
        $this->middleware('permission:order-update,admin')->only(['edit', 'update']);
        $this->middleware('permission:order-destroy,admin')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queries = get_query_strings(); // get all query

        $orders = Order::with(['user'])
        ->when(isset($queries['user']), function($query)use($queries) {
            return $query->whereIn("created_by", $queries['user']);
        })
        ->when(isset($queries['type']), function($query)use($queries) {
            return $query->whereIn('job_type', $queries['type']);
        })
        ->when(isset($queries['status']), function($query)use($queries) {
            return $query->whereIn('status', $queries['status']);
        })
        ->orderBy('id', 'desc')
        ->get();
        $users = User::select(['id', 'name'])->get();
        return view('admin.orders.index', compact('orders', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['user'])->findOrFail($id);
        $galleries = json_decode($order->gallery);
        return view("admin.orders.show", compact('order', 'galleries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $order = Order::findOrFail($id);
        $order->update($data);
        return redirect()->route('admin.orders.index')->with('message', 'Order updated successfull!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route("admin.orders.index")->with("message", "Order delete successfull!");
    }
}
