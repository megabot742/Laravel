<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdprofileController extends Controller
{
    public function ViewIndexAd()
    {
        return view('admin.aduser_profile');
    }
    public function ViewCheckAd(Request $request)
    {
        $user_id = session('ad_id');
        if (!$user_id) {
            return redirect('/login');
        } else {

            //Update name và email
            $name = $request->input('name');
            $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = $request->input('email');
            $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'name' => $name,
                    'email' => $email,
                ]);
            //Thay đổi giá trị
            session()->put('adname', $name);
            session()->put('ademail', $email);

            $image = $request->file('image');
            //Update image
            if ($image) {
                $image_tmp_name = $image->getPathname();
                $image_folder =  public_path('uploadimg/' . $image->getClientOriginalName());
                $image_size = $image->getSize();
                if ($image_size > 2000000) {
                    session()->flash('message', 'Image size is too large!');
                    return redirect('/adprofile');
                } else {
                    DB::table('users')
                        ->where('id', $user_id)
                        ->update(['image' =>  $image->getClientOriginalName()]);

                    move_uploaded_file($image_tmp_name, $image_folder);

                    $old_image = $request->input('old_image');
                    if ($old_image) {
                        unlink(public_path('uploadimg/' . $old_image));
                    }
                    session()->put('adimage', $image->getClientOriginalName());
                    session()->flash('messagedone', 'Image Updated Successfully!');
                    return redirect('/adprofile');
                }
            }

            //Update password
            if ($request->filled('old_pass') && $request->filled('update_pass') && $request->filled('new_pass') && $request->filled('confirm_pass')) {
                $old_pass = $request->input('old_pass');
                $old_pass = filter_var($old_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $update_pass = md5($request->input('update_pass'));
                $update_pass = filter_var($update_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $new_pass = md5($request->input('new_pass'));
                $new_pass = filter_var($new_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirm_pass = md5($request->input('confirm_pass'));
                $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                if ($update_pass != $old_pass) {
                    session()->flash('message', 'Old password not matched!');
                    return redirect('/adprofile');
                } elseif ($new_pass != $confirm_pass) {
                    session()->flash('message', 'Confirm password not matched!');
                    return redirect('/adprofile');
                } else {
                    DB::table('users')
                        ->where('id', $user_id)
                        ->update(['password' => $confirm_pass]);
                    session()->put('adpass', $confirm_pass);
            
                    session()->flash('messagedone', 'Password updated successfully!');
                    return redirect('/adprofile');
                }
            }
            return redirect('/adprofile');
            
        }
    }
}
