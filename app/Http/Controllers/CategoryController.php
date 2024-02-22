<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function productsByCategory($category)
    {
        $products = DB::table('products')
            ->where('category', $category)
            ->get();

        return view('user.category', ['products' => $products]);
    }
    public function addProductsByCategory($category, Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        if ($request->has('add_to_wishlist')) {
            $pid = $request->input('pid');
            $p_name = $request->input('p_name');
            $p_price = $request->input('p_price');
            $p_image = $request->input('p_image');

            $check_wishlist_numbers = DB::table('wishlist')
                ->where('name', $p_name)
                ->where('user_id', $user_id)
                ->count();

            $check_cart_numbers = DB::table('cart')
                ->where('name', $p_name)
                ->where('user_id', $user_id)
                ->count();

            if ($check_wishlist_numbers > 0) {
                session()->flash('message', 'Already added to wishlist!');
            } elseif ($check_cart_numbers > 0) {
                session()->flash('message', 'Already added to cart!');
            } else {
                DB::table('wishlist')->insert([
                    'user_id' => $user_id,
                    'pid' => $pid,
                    'name' => $p_name,
                    'price' => $p_price,
                    'image' => $p_image,
                ]);
                session()->flash('messagedone', 'Added to wishlist!');
            }
        }
        if ($request->has('add_to_cart')) {
            $pid = $request->input('pid');
            $p_name = $request->input('p_name');
            $p_price = $request->input('p_price');
            $p_image = $request->input('p_image');
            $p_qty = $request->input('p_qty');

            $check_cart_numbers = DB::table('cart')
                ->where('name', $p_name)
                ->where('user_id', $user_id)
                ->count();

            if ($check_cart_numbers > 0) {
                session()->flash('message', 'Already added to cart!');
            } else {
                $check_wishlist_numbers = DB::table('wishlist')
                    ->where('name', $p_name)
                    ->where('user_id', $user_id)
                    ->count();

                if ($check_wishlist_numbers > 0) {
                    DB::table('wishlist')
                        ->where('name', $p_name)
                        ->where('user_id', $user_id)
                        ->delete();
                }

                DB::table('cart')->insert([
                    'user_id' => $user_id,
                    'pid' => $pid,
                    'name' => $p_name,
                    'price' => $p_price,
                    'quantity' => $p_qty,
                    'image' => $p_image,
                ]);
                session()->flash('messagedone', 'Added to cart!');
            }
        }
        $products = DB::table('products')
            ->where('category', $category)
            ->get();

        return view('user.category', ['products' => $products]);
    }
}
