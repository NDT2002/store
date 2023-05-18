<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie; 
use App\Models\Product; 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
        return view ('Products.index',['Products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Categorie::all();
        return view('Products.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->has('images')) {
            foreach ($request->images as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/images', $filename);
                $image->move(public_path('images'),$filename);
                $image_urls[] = $path;
            }
        }
        
        $input['image_url'] = json_encode($image_urls);
        Product::create($input);
        return redirect('store/Products')->with('flash_message', 'Thêm sản phẩm thành công');  
    }

    /**
     * Display the specified resource.
     */

    public function show( $id)
    {
        $product = Product::find($id);
        $category=Categorie::find($product->category_id);
        $categories=$category->name;
        return view('products.show',compact('product', 'product'),compact('categories', 'categories'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories=Categorie::all();
        return view('Products.edit')
        ->with('categories', $categories)
        ->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products = Product::find($id);
        $input = $request->all();
        if($request->has('images')) {
            foreach ($request->images as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/images', $filename);
                $image->move(public_path('images'),$filename);
                $image_urls[] = $path;
            }
            $input['image_url'] = json_encode($image_urls);
        }
        
        $products->update($input);
        return redirect('store/Products')->with('flash_message', 'Cập nhật sản phẩm thành công');  
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $products = Product::where('name', 'like', '%' . $name . '%')->get();

        return response()->json($products);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect('store/Products')->with('flash_message', 'Xóa sản phẩm thành công');  
    }
}