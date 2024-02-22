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
        <section class="shopping-cart">
            <h1 class="title">Products Added</h1>
            @if (session()->has('messagedone'))
                <div id="alert-message" class="alert alert-success">
                    <strong>{{ session('messagedone') }}</strong>
                </div>
            @endif
            <div class="box-container">
                @if ($select_cart->count() > 0)
                    @foreach ($select_cart as $fetch_cart)
                        <form action="cart" method="POST" class="box" enctype="multipart/form-data">
                            @csrf
                            <a href="{{ route('cartdelete', $fetch_cart->id) }}" class="fas fa-times"
                                onclick="return confirm('Delete this from cart?');"></a>
                            <a href="{{ url('viewpage', ['id' => $fetch_cart->pid]) }}" class="fas fa-eye"></a>
                            <img src="{{ asset('uploadimg/' . $fetch_cart->image) }}" alt="">
                            <div class="name">{{ $fetch_cart->name }}</div>
                            <div class="price">${{ $fetch_cart->price }}</div>
                            <input type="hidden" name="cart_id" value="{{ $fetch_cart->id }}">
                            <div class="flex-btn">
                                <input type="number" min="1" value="{{ $fetch_cart->quantity }}" class="qty"
                                    name="p_qty">
                                <input type="submit" value="Update" name="update_qty" class="option-btn">
                            </div>
                            <div class="sub-total">Sub Total:
                                <span>${{ $sub_total = $fetch_cart->price * $fetch_cart->quantity }}</span>
                            </div>
                        </form>
                        <?php $grand_total += $sub_total; ?>
                    @endforeach
                @else
                    <p class="empty">Your cart is empty</p>
                @endif
            </div>
            <div class="cart-total">
                <p>Grand total: <span>${{ $grand_total }}</span></p>
                <a href="{{ url('/shop') }}" class="option-btn">Continue Shopping</a>
                <a href="{{ route('cartdelete_all') }}" class="delete-btn {{ $grand_total > 1 ? '' : 'disabled' }}">Delete
                    All</a>
                <a href="{{ url('/checkout') }}" class="btn {{ $grand_total > 1 ? '' : 'disabled' }}">Proceed To
                    Checkout</a>
            </div>
        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
