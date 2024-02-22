<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function indexProducts()
    {
        $products = DB::table('products')->limit(6)->get();
        return view('user.home', compact('products'));
        
    }
}
