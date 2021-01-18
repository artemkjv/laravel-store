<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class BasketController extends Controller
{

    private $basket;

    public function __construct() {
        $this->basket = Basket::getBasket();
    }

    public function index(Request $request){
        return view('basket.index', ["basket" => $this->basket]);
    }

    public function checkout(){
        if(Basket::getCount() != 0)
            return view("basket.checkout");
        else
            abort(404);
    }

    public function add(Request $request, $id){
        $quantity = $request->input('quantity') ?? 1;
        $this->basket->increase($id, $quantity);
        return back();
    }

    public function plus(Request $request, $id){
        $this->basket->increase($id);
        return redirect()->route('basket');
    }

    public function minus(Request $request, $id){
        $this->basket->decrease($id);
        return redirect()->route('basket');
    }

    public function remove($id){
        $this->basket->remove($id);
        return redirect()->route("basket");
    }

    public function clear(){
        $this->basket->products()->sync([]);
        return redirect()->route("basket");
    }

    public function saveOrder(Request $request){
        $request->validate([
            'name' => ["required", "max:255"],
            'email' => ["required", "email","max:255"],
            'phone' => ["required", "max:255"],
            'address' => ["required", "max:255"],
        ]);
        $basket = Basket::getBasket();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $request->all() + ['amount' => $basket->getAmount(), 'user_id' => $user_id]
        );
        foreach ($basket->products as $product){
            $order->items()->create([
                "product_id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "count" => $product->pivot->quantity,
                "cost" => $product->price * $product->pivot->quantity,
            ]);
        }
        $basket->delete();
        Cookie::queue(Cookie::forget('basket_id'));
        return redirect()
            ->route('basket.success')
            ->with('order_id', $order->id);
    }

    public function success(Request $request){
        if ($request->session()->exists('order_id')) {
            $order_id = $request->session()->pull('order_id');
            $order = Order::find($order_id);
            return view('basket.success', compact('order'));
        } else {
            return redirect()->route('basket');
        }
    }

}
