<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genshin Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

</head>

<body>
    @extends('app')
    @section('content')
        <section class="display-orders">
            @if ($cart_items->count() > 0)
                @foreach ($cart_items as $cart_item)
                    <p> {{ $cart_item->name }} <span>({{ '$' . $cart_item->price . '/x' . $cart_item->quantity }})</span>
                    </p>
                @endforeach
                <div class="grand-total">Grand Total : <span>${{ $cart_grand_total }}</span></div>
            @else
                <p class="empty">your cart is empty!</p>
            @endif
            @if (session()->has('message'))
                <div  id="alert-message" class="alert alert-danger">
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            @if (session()->has('messagedone'))
                <div  id="alert-message" class="alert alert-success">
                    <strong>{{ session('messagedone') }}</strong>
                </div>
            @endif
        </section>
        <section class="checkout-orders">

            <form action="{{ url('/checkout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Place Your Order</h3>
                <div class="flex">
                    <div class="inputBox">
                        <span>Your name :</span>
                        <input type="text" name="name" placeholder="enter your name" class="box" required>
                    </div>
                    <div class="inputBox">
                        <span>Your number :</span>
                        <input type="number" name="number" placeholder="enter your number" class="box" required>
                    </div>
                    <div class="inputBox">
                        <span>Your email :</span>
                        <input type="email" name="email" placeholder="enter your email" class="box" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment method :</span>
                        <select name="method" class="box" required>
                            <option value="cash on delivery">cash on delivery</option>
                            <option value="vnpay">VNPay</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Number house address:</span>
                        <input type="text" name="flat" placeholder="enter house number, ex: 81/2/3b" class="box"
                            required>
                    </div>
                    <div class="inputBox">
                        <span>Stress address:</span>
                        <input type="text" name="street" placeholder="enter street name, ex: Nguyen Minh Chau Stress"
                            class="box" required>
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" name="city" placeholder="enter city, ex: Ho Chi Minh City" class="box"
                            required>
                    </div>
                    <div class="inputBox">
                        <span>State :</span>
                        <input type="text" name="state" placeholder="enter state, ex: Quarter 4" class="box"
                            required>
                    </div>
                    <div class="inputBox">
                        <span>Country :</span>
                        <input type="text" name="country" placeholder="enter country, ex: VietNam" class="box"
                            required>
                    </div>
                    <div class="inputBox">
                        <span>Pin code :</span>
                        <input type="number" min="0" name="pin_code" placeholder="enter pin code, ex: 123456"
                            class="box" required>
                    </div>
                </div>
                @if ($cart_items->count() > 0)
                    <input type="hidden" name="total" value="{{ $cart_grand_total }}">
                @endif
                <input type="submit" name="redirect" class="btn" value="place order">
            </form>
            {{-- <form action="{{ url('/vnpay') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($cart_items->count() > 0)
                    <input type="hidden" name="total" value="{{ $cart_grand_total }}">
                @endif
                <input type="submit" name="redirect" class="btn" value="place order online">
            </form> --}}

        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
