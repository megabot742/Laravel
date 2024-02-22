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
        <section class="quick-view">

            <h1 class="title">Quick View</h1>
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
            @if ($product)
                <form action="{{ url('viewpage', ['id' => $product->id]) }}" class="box" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="price">${{ $product->price }}</div>
                    <img src="{{ asset('uploadimg/' . $product->image) }}" alt="">
                    <div class="name">{{ $product->name }}</div>
                    <div class="details">{{ html_entity_decode($product->details) }}</div>
                    <input type="hidden" name="pid" value="{{ $product->id }}">
                    <input type="hidden" name="p_name" value="{{ $product->name }}">
                    <input type="hidden" name="p_price" value="{{ $product->price }}">
                    <input type="hidden" name="p_image" value="{{ $product->image }}">
                    <input type="number" min="1" value="1" name="p_qty" class="qty">
                    <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                    <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                </form>
            @else
                <p class="empty">No products view yet!</p>
            @endif

        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
