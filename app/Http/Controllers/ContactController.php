<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function viewContact()
    {
        return view('user.contact');
    }
    public function sendMessage(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        if ($request->isMethod('post')) {
            $name = $request->input('name');
            $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = $request->input('email');
            $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $number = $request->input('number');
            $number = filter_var($number, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $msg = $request->input('msg');
            $msg = filter_var($msg, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $select_message = DB::table('message')
                ->where('name', $name)
                ->where('email', $email)
                ->where('number', $number)
                ->where('message', $msg)
                ->get();

            if ($select_message->count() > 0) {
                session()->flash('message', 'Already sent message!');
            } else {
                DB::table('message')
                    ->insert([
                        'user_id' => $user_id,
                        'name' => $name,
                        'email' => $email,
                        'number' => $number,
                        'message' => $msg
                    ]);

                session()->flash('messagedone', 'Sent message successfully!');
            }
        }
        return redirect('contact');
    }
}
