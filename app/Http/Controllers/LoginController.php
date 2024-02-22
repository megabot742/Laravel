<?php

namespace App\Http\Controllers;

use App\Models\UserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function LoginIndex()
    {
        return view('login');
    }
    public function LoginCheck(Request $request)
    {
        $email = $request->input('email');
        $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = md5($request->input('pass'));
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = DB::table('users')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($user) {
            if ($user->user_type == 'admin') {
                session()->put('ad_id', $user->id);
                session()->put('adname', $user->name);
                session()->put('adimage', $user->image);
                session()->put('ademail', $user->email);
                session()->put('adpass', $user->password);
                return redirect('adhome');
            } elseif ($user->user_type == 'user') {
                session()->put('user_id', $user->id);
                session()->put('username', $user->name);
                session()->put('userimage', $user->image);
                session()->put('useremail', $user->email);
                session()->put('userpass', $user->password);
                return redirect('');
            } else {
                session()->flash('message', 'No User Found!'); 
                return redirect('/login');           
            }
        } else {
            session()->flash('message', 'Incorrect email or Password!');    
            return redirect('/login');     
        }
    }
    
    
}
