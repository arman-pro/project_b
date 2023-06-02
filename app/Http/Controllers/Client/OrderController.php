<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->where('created_by', Auth::id())->get();
        return view('clients.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $data = $request->all();
        $gallery_data = [];
        if($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $gallery) {
                $file_name = date('d_m_y_').'_gallery_'.substr(rand(), 0, 5). '.' . $gallery->extension();
                $gallery->storeAs('public/gallery', $file_name);
                $gallery_data[] = $file_name;
            }
        }    
        $data['gallery'] = json_encode($gallery_data);
        $data['created_by'] = Auth::id();
        $order = Order::create($data);
        return redirect()->route('payment', ['order' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $galleries = json_decode($order->gallery);
        return view('clients.orders.edit', compact('order', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $galleries = json_decode($order->gallery);
        $removed_item = array_diff($galleries, $request->old ?? []);
        
        if(count($removed_item) > 0) {
            foreach($removed_item as $item) {
                $path = public_path('storage/gallery/'.$item);
                if(file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $gallery_data = [];
        if($request->old) {
            foreach($request->old as $old_gallery) {
                $gallery_data[] = $old_gallery;
            }
        }
      
        if($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $gallery) {
                $file_name = date('d_m_y_').'_gallery_'.substr(rand(), 0, 5). '.' . $gallery->extension();
                $gallery->storeAs('public/gallery', $file_name);
                $gallery_data[] = $file_name;
            }
        }                

        $data = $request->all();
        $data['gallery'] = json_encode($gallery_data);
        $data['created_by'] = Auth::id();
        $order->update($data);
        return redirect()->route('dashboard.orders.index')->with('message', "Order Updated Successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->created_by != Auth::id()) {
            return redirect()->back()->with('message', 'Sorry! You can not delete it!');
        }
        $galleries = json_decode($order->gallery);        
        if(count($galleries) > 0) {
            foreach($galleries as $item) {
                $path = public_path('storage/gallery/'.$item);
                if(file_exists($path)) {
                    unlink($path);
                }
            }
        }
        $order->delete();
        return redirect()->route('dashboard.orders.index')->with("message", "Order delete successfull!");
    }
}
