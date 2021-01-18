<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderByDesc("created_at")->with("user")->paginate(5);
        $statuses = Order::STATUSES;
        return view("admin.order.index", compact("orders", "statuses"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::query()->with("items")->find($id);
        $statuses = Order::STATUSES;
        return view("admin.order.show", compact("order", "statuses"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::query()->with("items")->find($id);
        $statuses = Order::STATUSES;
        return view("admin.order.edit", compact("order", "statuses"));
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
            "status" => ["required"],
            "name" => ["required", "max:250"],
            "email" => ["required", "max:250"],
            "phone" => ["required"],
            "address" => ["required", "max:250"],
        ]);
        $data = $request->all();
        $order = Order::find($id);
        $order->update($data);
        return redirect()->route("admin.orders");
    }

}
