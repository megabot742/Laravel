<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlisttController extends Controller
{
    public function indexWishList()
    {
        $grandTotal = 0;
        $wishlistItems = [];
        $user_id = session('user_id');

        $wishlistItems = DB::table('wishlist')
            ->where('user_id', $user_id)
            ->get();

        $wishlistCount = count($wishlistItems);

        foreach ($wishlistItems as $wishlistItem) {
            $grandTotal += $wishlistItem->price;
        }

        return view('user.wishlist', [
            'wishlistItems' => $wishlistItems,
            'wishlistCount' => $wishlistCount,
            'grandTotal' => $grandTotal
        ]);
    }
    public function addtoCart(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        if ($request->has('add_to_cart')) {
            $pid = $request->input('pid');
            $p_name = $request->input('p_name');
            $p_price = $request->input('p_price');
            $p_image = $request->input('p_image');
            $p_qty = $request->input('p_qty');

            $checkCartNumbers = DB::table('cart')
                ->where('name', $p_name)
                ->where('user_id', $user_id)
                ->count();

            if ($checkCartNumbers > 0) {
                session()->flash('messagedone', 'Already added to cart!');
            } else {
                $checkWishlistNumbers = DB::table('wishlist')
                    ->where('name', $p_name)
                    ->where('user_id', $user_id)
                    ->count();
                if ($checkWishlistNumbers > 0) {
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
        $wishlistItems = DB::table('wishlist')->where('user_id', $user_id)->get();
        $wishlistCount = count($wishlistItems);
        $grandTotal = $wishlistItems->sum('price');

        return view('user.wishlist', [
            'wishlistItems' => $wishlistItems,
            'wishlistCount' => $wishlistCount,
            'grandTotal' => $grandTotal
        ]);
    }
    public function delete($id)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        DB::table('wishlist')->where('id', $id)->delete();
        session()->flash('messagedone', 'Delete done!');
        return redirect('wishlist');
    }

    public function deleteAll()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        DB::table('wishlist')->where('user_id', $user_id)->delete();
        session()->flash('messagedone', 'DeleteAll done!');
        return redirect('wishlist');
    }
}
