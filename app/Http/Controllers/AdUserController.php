<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdUserController extends Controller
{
    public function indexUser()
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        }
        else{
            $users = DB::table('users')->get();
            return view('admin.aduser', compact('users'));
        }
    }
    public function deleteUser($id)
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        }
        else{
            DB::table('users')->where('id', $id)->delete();

            session()->flash('messagedone', 'User has been deleted!');
            $users = DB::table('users')->get();
            return view('admin.aduser', compact('users'));
        }
    }
}
