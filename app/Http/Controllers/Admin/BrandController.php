<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);
        return view("admin.brand.index", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.brand.create");
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
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        if($request->hasFile("image")){
            $data["image"] = $request->file("image")->store("images/brands", "public");
        }
        Brand::create($data);
        return redirect()->route("admin.brands");
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
        $brand = Brand::find($id);
        return view("admin.brand.edit", compact("brand"));
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
            "image" => ["image", "nullable"]
        ]);
        $data = $request->all();
        $brand = Brand::find($id);
        if($request->hasFile("image")){
            Storage::delete("public/".$brand->image);
            $data["image"] = $request->file("image")->store("images/brands", "public");
        }
        else{
            $data["image"] = $brand->image;
        }
        $brand->update($data);
        return redirect()->route("admin.brands");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        Storage::delete("public/".$brand->image);
        $brand->delete();
        return redirect()->route("admin.brands");
    }
}
