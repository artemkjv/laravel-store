<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function index(){
        $roots = Category::where("parent_id", 0)->get();
        return view("catalog.index", compact("roots"));
    }

    public function category($slug){
        $category = Category::where("slug", $slug)->get()->first();
        return view("catalog.category", compact("category"));
    }

    public function brand($slug){
        $brand = Brand::where("slug", $slug)->get()->first();
        return view("catalog.brand", compact("brand"));
    }

    public function product($slug){
        $product = Product::where("slug", $slug)->get()->first();
        return view("catalog.product", compact("product"));
    }

}