<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class Basket extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function increase($id, $count = 1) {
        $this->change($id, $count);
    }

    public function decrease($id, $count = 1) {
        $this->change($id, -1 * $count);
    }

    public static function getBasket() {
        try {
            $basket_id = explode("|", decrypt(Cookie::get('basket_id'), false))[1];
        } catch (\Exception $e) {
            $basket_id = Cookie::get("basket_id");
        }
        if (!empty($basket_id)) {
            try {
                $basket = Basket::find($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = Basket::create();
            }
        } else {
            $basket = Basket::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);
        return $basket;
    }

    public function getAmount() {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }

    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        if ($this->products->contains($id)) {
            $pivotRow = $this->products()->find($id)->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                $pivotRow->delete();
            }
        } elseif ($count > 0) {
            $this->products()->attach($id, ['quantity' => $count]);
        }
        $this->touch();
    }

    public static function getCount() {
        $basket_id = request()->cookie('basket_id');
        if (empty($basket_id)) {
            return 0;
        }
        return self::getBasket()->products->count();
    }

    public function remove($id) {
        $this->products()->detach($id);
        $this->touch();
    }

}
