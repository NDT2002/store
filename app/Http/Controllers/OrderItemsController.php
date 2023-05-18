<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\Order_item; 

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Orders=Order::all();
        return view ('orders.index',['Orders'=> $Orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Order::create($input);
        return redirect('store/Order')->with('flash_message', 'Thêm sản phẩm thành công');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Orders = Order::find($id);
        $order_items = $Orders->Order_items;
        return view('orders.show',compact('Orders', 'order_items'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Orders = Order::find($id);
        return view('orders.edit')->with('Orders', $Orders);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $Orders = Order::find($id);
        $input = $request->all();
        $Orders->update($input);
        return redirect('store/Orders')->with('flash_message', 'Cập nhật sản phẩm thành công');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::destroy($id);
        return redirect('store/Orders')->with('flash_message', 'Xóa sản phẩm thành công');  
    }
}
