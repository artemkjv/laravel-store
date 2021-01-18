<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view("admin.product.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->whereNotIn("parent_id", [0])->get();
        $brands = Brand::all();
        return view("admin.product.create", compact("categories", "brands"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "max:250"],
            "content" => ["required", "max:250"],
            "price" => ["required"],
            "category_id" => ["required"],
            "brand_id" => ["required"],
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        if($request->hasFile("image")){
            $data["image"] = $request->file("image")->store("images/products", "public");
        }
        Product::create($data);
        return redirect()->route("admin.products");
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
    public function edit($id)
    {
        $categories = Category::query()->whereNotIn("parent_id", [0])->get();
        $brands = Brand::all();
        $product = Product::find($id);
        return view("admin.product.edit", compact("categories", "brands", "product"));
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
        $request->validate([
            "name" => ["required", "max:250"],
            "content" => ["required"],
            "price" => ["required"],
            "category_id" => ["required"],
            "brand_id" => ["required"],
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        $product = Product::find($id);
        if($request->hasFile("image")){
            Storage::delete("public/".$product->image);
            $data["image"] = $request->file("image")->store("images/products", "public");
        }
        else{
            $data["image"] = $product->image;
        }
        $product->update($data);
        return redirect()->route("admin.products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete("public/".$product->image);
        $product->delete();
        return redirect()->route("admin.products");
    }
}
