<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdOrderController extends Controller
{
    public function indexOrder()
    {
        $orders = DB::table('orders')->get();
        return view('admin.adorder', compact('orders'));
    }

    public function updateOrder(Request $request, $id)
    {
        $update_payment = $request->input('update_payment');

        DB::table('orders')
            ->where('id', $id)
            ->update(['payment_status' => $update_payment]);

        session()->flash('messagedone', 'Payment has been updated!');
        $orders = DB::table('orders')->get();
        return view('admin.adorder', compact('orders'));
    }

    public function deleteOrder($id)
    {
        DB::table('orders')->where('id', $id)->delete();

        session()->flash('messagedone', 'Order has been deleted!');
        $orders = DB::table('orders')->get();
        return view('admin.adorder', compact('orders'));
    }
}
