<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class RegisterController extends Controller
{
    public function RegisterIndex()
    {
        return view('register');
    }
    public function RegisterCheck(Request $request)
    {
        $name = $request->input('name');
        $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = $request->input('email');
        $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = md5($request->input('pass'));
        $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cpass = md5($request->input('cpass'));
        $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $image = $request->file('image');
        $image_size = $image->getSize();
        $image_tmp_name = $image->getPathname();
        $image_folder =  public_path('uploadimg/' . $image->getClientOriginalName());

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if ($user) {
            session()->flash('message', 'User email already exists!');
            return redirect('/register'); 
        } else {
            if ($pass != $cpass) {
                session()->flash('message', 'Confirm password not matched!');
                return redirect('/register'); 
            } else {
                $insert = DB::table('users')
                    ->insert([
                        'name' => $name,
                        'email' => $email,
                        'password' => $pass,
                        'image' => $image->getClientOriginalName()
                    ]);

                if ($insert) {
                    if ($image_size > 2000000) {
                        session()->flash('message', 'Image size is too large!');
                        return redirect('/register');
                    } else {
                        move_uploaded_file($image_tmp_name, $image_folder);
                        session()->flash('messagedone', 'Registered successfully!'); 
                        return redirect('/register');
                    }
                }
            }
        }
    }
}
