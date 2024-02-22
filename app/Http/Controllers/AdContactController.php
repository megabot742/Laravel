<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdContactController extends Controller
{
    public function indexContact()
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        } else {
            $messages = DB::table('message')->get();
            return view('admin.adcontact', compact('messages'));
        }
    }

    public function deleteContact($id)
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        }
        else{
            DB::table('message')->where('id', $id)->delete();
            session()->flash('messagedone', 'Contact has been deleted!');
            $messages = DB::table('message')->get();
            return view('admin.adcontact', compact('messages'));
        }
    }
}
