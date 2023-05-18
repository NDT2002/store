<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie; 
use App\Models\Product; 
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories=Categorie::all();
        return view ('categories.index',['categories'=> $Categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Categorie::create($input);
        return redirect('store/categories')->with('flash_message', 'Thêm sản phẩm thành công');  
    }

    /**
     * Display the specified resource.
     */
    public function show( $category_id)
    {
        $Categories = Categorie::find($category_id);
        $products = $Categories->Products;
        return view('categories.show',compact('Categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Categories = Categorie::find($id);
        return view('categories.edit')->with('Categories', $Categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Categories = Categorie::find($id);
        $input = $request->all();
        $Categories->update($input);
        return redirect('store/categories')->with('flash_message', 'Cập nhật sản phẩm thành công');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categorie::destroy($id);
        return redirect('store/categories')->with('flash_message', 'Xóa sản phẩm thành công');  
    }
}
