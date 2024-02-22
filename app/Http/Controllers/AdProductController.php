<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdProductController extends Controller
{
    public function indexProduct()
    {
        $products = DB::table('products')->get();

        return view('admin.adproduct', compact('products'));
    }
    public function addProduct(Request $request)
    {
        $admin_id = session('ad_id');
        if (!$admin_id) {
            return redirect('/login');
        } else {
            $name = $request->input('name');
            $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price = $request->input('price');
            $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category = $request->input('category');
            $category = filter_var($category, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $details = $request->input('details');
            $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $image = $request->file('image');
            $image_size = $image->getSize();
            $image_tmp_name = $image->getPathname();
            $image_folder =  public_path('uploadimg/' . $image->getClientOriginalName());

            $existingProduct = DB::table('products')
                ->where('name', $name)
                ->first();

            if ($existingProduct) 
            {
                session()->flash('message', 'Product name already exists!'); 
                return redirect('/adproduct');
            } else {
                $productId = DB::table('products')->insertGetId([
                    'name' => $name,
                    'category' => $category,
                    'details' => $details,
                    'price' => $price,
                    'image' => $image->getClientOriginalName(),
                ]);

                if ($productId) {
                    if ($image_size > 2000000) {
                        session()->flash('message', 'Image size is too large!');
                    } else {
                        move_uploaded_file($image_tmp_name, $image_folder);
                        session()->flash('messagedone', 'New product added!'); 
                        return redirect('/adproduct');
                    }
                }
            }
        }
        return redirect('/adproduct');
    }

    public function deleteProduct($id)
    {
        $selectDeleteImage = DB::table('products')
            ->where('id', $id)
            ->select('image')
            ->first();

        if ($selectDeleteImage) 
        {
            $imagePath = public_path('uploadimg/' . $selectDeleteImage->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        DB::table('products')->where('id', $id)->delete();
        DB::table('wishlist')->where('pid', $id)->delete();
        DB::table('cart')->where('pid', $id)->delete();

        return redirect('/adproduct');
    }
}
