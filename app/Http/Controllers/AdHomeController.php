<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdHomeController extends Controller
{
    public function indexHome()
    {
        $total_pendings = 0;
        $select_pendings = DB::table('orders')->where('payment_status', 'pending')->get();
        foreach ($select_pendings as $fetch_pendings) {
            $total_pendings += $fetch_pendings->total_price;
        }

        $total_completed = 0;
        $select_completed = DB::table('orders')->where('payment_status', 'completed')->get();
        foreach ($select_completed as $fetch_completed) {
            $total_completed += $fetch_completed->total_price;
        }

        $number_of_orders = DB::table('orders')->count();
        $number_of_products = DB::table('products')->count();
        $number_of_users = DB::table('users')->where('user_type', 'user')->count();
        $number_of_admins = DB::table('users')->where('user_type', 'admin')->count();
        $number_of_accounts = DB::table('users')->count();
        $number_of_messages = DB::table('message')->count();

        return view('admin.adhome', compact('total_pendings', 'total_completed', 'number_of_orders', 'number_of_products', 'number_of_users', 'number_of_admins', 'number_of_accounts', 'number_of_messages'));
    }
}
