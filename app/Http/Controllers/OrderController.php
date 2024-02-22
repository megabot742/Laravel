<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placedOrders()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        $select_orders = DB::table('orders')
            ->where('user_id', $user_id)
            ->get();

        return view('user.order', ['orders' => $select_orders]);
    }
}
