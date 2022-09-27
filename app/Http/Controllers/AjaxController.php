<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function addCart(Request $request, $productId) {
        $product = Product::where('id', $productId)->first();
        if (!empty($request->session()->get('carts'))) {
            $products = $request->session()->get('carts');
            $price = $request->session()->get('price');
            $total = $request->session()->get('total');
            $carts = [];
            foreach ($products as $key => $cart) {
                if (empty($cart['countCart'])) {
                    $cart['countCart'] = 1;
                }
                if ($cart['id'] == $product->id) {
                    $cart['countCart'] += 1;
                    $check = true;
                }
                array_push($carts, $cart);
            }
            if (empty($check)) {
                $product['countCart'] = 1; 
                array_push($carts, $product);
            }
            $total += 1;
            $product->price_applied == 1 ? $price += $product->unit_price : $price += $product->promotion_price;
        } else {
            $carts = [];
            $product['countCart'] = 1;
            $total = 1;
            array_push($carts, $product);
            $product->price_applied == 1 ? $price = $product->unit_price : $price = $product->promotion_price;
        }

        $request->session()->put('carts', $carts);
        $request->session()->put('price', $price);
        $request->session()->put('total', $total);

        return 'ok';
    }

    public function removeCart(Request $request, $key) {
        $products = $request->session()->get('carts');
        $price = $request->session()->get('price');
        $total = $request->session()->get('total');

        $product = $products[$key];

        $price -= $product->price_applied == 1 ? ($product->unit_price * $product['countCart']) : ($product->promotion_price * $product['countCart']);
        $total -= $product['countCart'];

        unset($products[$key]);

        if (count($products) == 0) {
            $request->session()->forget('carts');
            $request->session()->forget('price');
            $request->session()->forget('total');
        } else {
            $request->session()->put('carts', $products);
            $request->session()->put('price', $price);
            $request->session()->put('total', $total);
        }

        return 'ok';
    }
}
