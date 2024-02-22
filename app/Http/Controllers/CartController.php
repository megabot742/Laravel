<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function showCart()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        $select_cart = DB::table('cart')->where('user_id', $user_id)->get();
        $grand_total = 0;

        return view('user.cart', compact('select_cart', 'grand_total'));
    }
    public function updateCart(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        $cart_id = $request->input('cart_id');
        $quantity = $request->input('p_qty');
        DB::table('cart')->where('id', $cart_id)->update(['quantity' => $quantity]);
        session()->flash('messagedone', 'Quantity updated!');
        return redirect('cart');
    }
    public function deleteCart($id)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        DB::table('cart')->where('id', $id)->delete();
        session()->flash('messagedone', 'Delete done!');
        return redirect('cart');
    }
    public function deleteAllCart()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        DB::table('cart')->where('user_id', $user_id)->delete();
        session()->flash('messagedone', 'DeleteAll done!');
        return redirect('cart');
    }
}
