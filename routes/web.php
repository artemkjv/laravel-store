<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["namespace" => "App\\Http\\Controllers\\"], function(){

    Route::get("/basket", "BasketController@index")->name("basket");
    Route::get("/basket/checkout", "BasketController@checkout")->name("basket.checkout");
    Route::post("/basket/checkout", "BasketController@saveOrder");
    Route::put("/basket/add/{id}", "BasketController@add")->name("basket.add");
    Route::post("/basket/minus/{id}", "BasketController@minus")->name("basket.minus");
    Route::post("/basket/plus/{id}", "BasketController@plus")->name("basket.plus");
    Route::get("/basket/clear", "BasketController@clear")->name("basket.clear");
    Route::get("/basket/remove/{id}", "BasketController@remove")->name("basket.remove");
    Route::get("/basket/success", "BasketController@success")->name("basket.success");

    Route::get("/catalog", "CatalogController@index")->name("catalog");
    Route::get("/catalog/brand/{slug}", "CatalogController@brand")->name("catalog.brand");
    Route::get("/catalog/category/{slug}", "CatalogController@category")->name("catalog.category");
    Route::get("/catalog/product/{slug}", "CatalogController@product")->name("catalog.product");
    Route::get("/", "HomeController@index")->name("home");

});

Route::name('user.')->prefix('user')->group(function () {
    Route::get('/index', 'App\\Http\\Controllers\\UserController@index')->name('index');
    Route::get("/logout", "App\\Http\\Controllers\\Auth\\LoginController@logout");
    Route::get("/edit", "App\\Http\\Controllers\\UserController@edit")->name("edit");
    Route::patch("/edit", "App\\Http\\Controllers\\UserController@update");

    Auth::routes();
});

Route::group(["as" => "admin.", "prefix" => "admin", "namespace" => "App\\Http\\Controllers\\Admin\\", "middleware" => ["admin"]],  function (){

    Route::get("/", "HomeController@index");
    Route::get("/categories", "CategoryController@index")->name("categories");
    Route::get("/category/create", "CategoryController@create")->name("category.create");
    Route::post("/category/create", "CategoryController@store");
    Route::get("/category/edit/{id}", "CategoryController@edit")->name("category.edit");
    Route::patch("/category/edit/{id}", "CategoryController@update");
    Route::delete("/category/delete/{id}", "CategoryController@destroy")->name("category.delete");

    Route::get("/brands", "BrandController@index")->name("brands");
    Route::get("/brand/create", "BrandController@create")->name("brand.create");
    Route::post("/brand/create", "BrandController@store");
    Route::get("/brand/edit/{id}", "BrandController@edit")->name("brand.edit");
    Route::patch("/brand/edit/{id}", "BrandController@update");
    Route::delete("/brand/delete/{id}", "BrandController@destroy")->name("brand.delete");

    Route::get('/products', "ProductController@index")->name("products");
    Route::get("/product/create", "ProductController@create")->name("product.create");
    Route::post("/product/create", "ProductController@store");
    Route::get("/product/edit/{id}", "ProductController@edit")->name("product.edit");
    Route::patch("/product/edit/{id}", "ProductController@update");
    Route::delete("/product/delete/{id}", "ProductController@destroy")->name("product.delete");

    Route::get("/orders", "OrderController@index")->name("orders");
    Route::get("/order/edit/{id}", "OrderController@edit")->name("order.edit");
    Route::patch("/order/edit/{id}", "OrderController@update");
    Route::get("/order/show/{id}", "OrderController@show")->name("order.show");

    Route::get("/users", "UserController@index")->name("users");
    Route::get("/user/edit/{id}", "UserController@edit")->name("user.edit");
    Route::patch("/user/edit/{id}", "UserController@update");
    Route::get("/user/show/{id}", "UserController@show")->name("user.show");
    Route::delete("/user/delete/{id}", "UserController@destroy")->name("user.delete");

});
