<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genshin Store</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

</head>

<body>
    @extends('app')
    @section('content')
        <section class="wishlist">

            <h1 class="title">Wishlist Products</h1>
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
            <div class="box-container">
                @if ($wishlistCount > 0)
                    @foreach ($wishlistItems as $wishlistItem)
                        <form action="wishlist" method="post" class="box" enctype="multipart/form-data">
                            @csrf
                            <a href="{{ route('wishlistdelete', $wishlistItem->id) }}" class="fas fa-times"
                                onclick="return confirm('Delete This From Wishlist?');"></a>
                            <a href="{{ url('viewpage', ['id' => $wishlistItem->pid]) }}" class="fas fa-eye"></a>
                            <img src="{{ asset('uploadimg/' . $wishlistItem->image) }}" alt="">
                            <div class="name">{{ $wishlistItem->name }}</div>
                            <div class="price">${{ $wishlistItem->price }}</div>
                            <input type="number" min="1" value="1" class="qty" name="p_qty">
                            <input type="hidden" name="pid" value="{{ $wishlistItem->pid }}">
                            <input type="hidden" name="p_name" value="{{ $wishlistItem->name}}">
                            <input type="hidden" name="p_price" value="{{ $wishlistItem->price}}">
                            <input type="hidden" name="p_image" value="{{ $wishlistItem->image}}">
                            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                        </form>
                    @endforeach
                @else
                    <p class="empty">Your Wishlist Is Empty</p>
                @endif

            </div>
            <div class="wishlist-total">
                <p>Grand Total : <span>${{$grandTotal}}</span></p>
                <a href="{{ url('/shop') }}" class="option-btn">Continue Shopping</a>
                <a href="{{ route('wishlistdelete_all') }}" class="delete-btn">Delete All</a>
            </div>

        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
