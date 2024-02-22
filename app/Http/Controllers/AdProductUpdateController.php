<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdProductUpdateController extends Controller
{
    public function viewProduct($id)
    {
        $products = DB::table('products')
            ->where('id', $id)
            ->first();
        return view('admin.adproduct_update', compact('products'));
    }
    public function updateProduct(Request $request)
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        } else {
            $pid = $request->input('pid');
            $name = $request->input('name');
            $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price = $request->input('price');
            $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category = $request->input('category');
            $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $details = $request->input('details');
            $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $old_image = $request->input('old_image');

            DB::table('products')
                ->where('id', $pid)
                ->update([
                    'name' => $name,
                    'price' => $price,
                    'category' => $category,
                    'details' => $details,
                ]);
            session()->flash('messagedone', 'Product updated successfully!');

            $image = $request->file('image');
            //Update image
            if ($image) {
                $image_tmp_name = $image->getPathname();
                $image_folder =  public_path('uploadimg/' . $image->getClientOriginalName());
                $image_size = $image->getSize();
                if ($image_size > 2000000) {
                    session()->flash('message', 'Image size is too large!');
                    return redirect('/userprofile');
                } else {
                    DB::table('products')
                        ->where('id', $pid)
                        ->update(['image' => $image->getClientOriginalName()]);

                    move_uploaded_file($image_tmp_name, $image_folder);

                    $old_image = $request->input('old_image');
                    if ($old_image) {
                        unlink(public_path('uploadimg/' . $old_image));
                    }
                    session()->flash('messagedone', 'Image Updated Successfully!');
                }
            }
            $products = DB::table('products')
                ->where('id', $pid)
                ->first();
            return view('admin.adproduct_update', compact('products'));
        }
    }
}
