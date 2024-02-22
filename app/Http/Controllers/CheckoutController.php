<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function viewcheckout()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        $cart_grand_total = 0;
        $cart_items = DB::table('cart')
            ->where('user_id', $user_id)
            ->get();

        if ($cart_items->count() > 0) {
            foreach ($cart_items as $cart_item) {
                $cart_total_price = ($cart_item->price * $cart_item->quantity);
                $cart_grand_total += $cart_total_price;
            }
        }
        return view('user.checkout', ['cart_items' => $cart_items, 'cart_grand_total' => $cart_grand_total]);
    }
    public function applycheckout(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return redirect('/login');
        }
        if ($request->has('redirect')) {
            $name = $request->input('name');
            $number = $request->input('number');
            $email = $request->input('email');
            $method = $request->input('method');
            $flat = $request->input('flat');
            $street = $request->input('street');
            $city = $request->input('city');
            $state = $request->input('state');
            $country = $request->input('country');
            $pin_code = $request->input('pin_code');
            $address = "flat no. $flat $street $city $state $country - $pin_code";
            $placed_on = date('d-M-Y');

            $cart_total = 0;
            $cart_products = [];

            $cart_items = DB::table('cart')
                ->where('user_id', $user_id)
                ->get();

            if ($cart_items->count() > 0) {
                foreach ($cart_items as $cart_item) {
                    $cart_products[] = $cart_item->name . ' ( ' . $cart_item->quantity . ' )';
                    $sub_total = ($cart_item->price * $cart_item->quantity);
                    $cart_total += $sub_total;
                }
            }

            $total_products = implode(', ', $cart_products);

            $order_exists = DB::table('orders')
                ->where('name', $name)
                ->where('number', $number)
                ->where('email', $email)
                ->where('method', $method)
                ->where('address', $address)
                ->where('total_products', $total_products)
                ->where('total_price', $cart_total)
                ->exists();

            if ($cart_total == 0) {
                $message[] = 'your cart is empty';
            } elseif ($order_exists) {
                $message[] = 'order placed already!';
            } else {
                $order_id=DB::table('orders')->insertGetId([
                    'user_id' => $user_id,
                    'name' => $name,
                    'number' => $number,
                    'email' => $email,
                    'method' => $method,
                    'address' => $address,
                    'total_products' => $total_products,
                    'total_price' => $cart_total,
                    'placed_on' => $placed_on
                ]);

                DB::table('cart')->where('user_id', $user_id)->delete();
                session()->flash('messagedone', 'Order placed successfully!');
            }
        }
        if ($method == 'vnpay') {
            $data = $request->all();
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/order";
            $vnp_TmnCode = "K2EFJUCC"; //Mã website tại VNPAY 
            $vnp_HashSecret = "DSMRYZOTDOBXVEUHTKHODLICGEFOLSTV"; //Chuỗi bí mật

            $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thông tin đơn hàng';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $data['total'] * 2457000;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,

            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            session()->flash('messagedone', 'Order placed successfully!');
        } else {
            $cart_grand_total = 0;
            $cart_items = DB::table('cart')
                ->where('user_id', $user_id)
                ->get();

            if ($cart_items->count() > 0) {
                foreach ($cart_items as $cart_item) {
                    $cart_total_price = ($cart_item->price * $cart_item->quantity);
                    $cart_grand_total += $cart_total_price;
                }
            }
            return view('user.checkout', ['cart_items' => $cart_items, 'cart_grand_total' => $cart_grand_total]);
        }
    }
}
