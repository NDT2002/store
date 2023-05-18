<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\Order_item; 
use App\Models\Product; 
use Carbon\Carbon;

class OrdersController extends Controller
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
        $products=Product::all();
        $now=Carbon::today()->format('Y-m-d');
        return view('orders.create',['products'=>$products],['now'=>$now]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $input = $request->all();
    $arr1 = $request->input('product-id', []);
    $arr2 = $request->input('quantity', []);
    $arr3 = $request->input('price', []);
    $order_items = array_map(function ($item1, $item2, $item3) {
        return ['product_id' => $item1, 'quantity' => $item2, 'price' => $item3];
    }, $arr1, $arr2, $arr3);

    $order = Order::create($input);
    $order->Order_item()->createMany($order_items);

    // Cập nhật số lượng sản phẩm trong bảng products
    foreach ($order_items as $item) {
        $product = Product::find($item['product_id']);

        if ($order->order_type == 0) {
            // Nếu order_type là 0, cộng thêm số lượng
            $product->quantity += $item['quantity'];
        } elseif ($order->order_type == 1) {
            // Nếu order_type là 1, trừ đi số lượng
            $product->quantity -= $item['quantity'];
        }

        $product->save();
    }

    return redirect('store/Orders')->with('flash_message', 'Thêm sản phẩm thành công');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Orders = Order::find($id);
        $Order_items = Order::find($id)->Order_item()->with('product')->get();

        return view('orders.show',compact('Orders', 'Order_items'));
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
        $order = Order::findOrFail($id);
        $orderItems = $order->Order_item;
        
        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product;
            $quantity = $orderItem->quantity;
            
            if ($order->order_type == 0) {
                // Nếu là loại hóa đơn nhập (order_type = 0), trừ đi số lượng
                $product->decrement('quantity', $quantity);
            } else {
                // Nếu là loại hóa đơn xuất (order_type = 1), cộng thêm số lượng
                $product->increment('quantity', $quantity);
            }
        }
        
        $order->delete();
        
        return redirect('store/Orders')->with('flash_message', 'Xóa sản phẩm thành công');  
    }

}