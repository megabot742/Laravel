<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function viewSearch()
    {
        return view('user.search_page');
    }
    public function FindSearch(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        $search_box = $request->input('search_box');
        $searchResults = [];

        if (!empty($search_box)) {
            $search_box = filter_var($search_box, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $searchResults = DB::table('products')
                ->where('name', 'LIKE', "%{$search_box}%")
                ->orWhere('category', 'LIKE', "%{$search_box}%")
                ->get();
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
        return view('user.search_page', ['searchResults' => $searchResults]);
    }
}
