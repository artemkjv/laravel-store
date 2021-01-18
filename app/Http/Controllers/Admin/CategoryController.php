<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where("parent_id", 0)->with("categories")->paginate(5);
        return view("admin.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where("parent_id", 0)->get();
        return view("admin.category.create", compact("categories"));
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
            "parent_id" => ["required"],
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        if($request->hasFile("image")){
            $data["image"] = $request->file("image")->store("images/categories", "public");
        }
        Category::create($data);
        return redirect()->route("admin.categories");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::where("parent_id", 0)->get();
        return view("admin.category.edit", ["category" => $category, "categories" => $categories]);
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
            "content" => ["required", "max:250"],
            "parent_id" => ["required"],
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        $category = Category::find($id);
        $category->slug = null;
        if($request->hasFile("image")){
            Storage::delete("public/".$category->image);
            $data["image"] = $request->file("image")->store("/images/categories", "public");
        }
        else{
            $data["image"] = $category->image;
        }
        $category->update($data);
        return redirect()->route("admin.categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
