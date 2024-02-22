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
        {{-- Slider content --}}
        <div class="home-bg">
            <section class="home">
                <div class="content">
                    <span>Grocery food Genshin Store</span>
                    <h3>Fresh, clean and cheap</h3>
                    <p>Experience the Taste of Freshness - Your Premier Choice for Flavorful Fare</p>
                    <a href="about.php" class="btn">about us</a>
                </div>
            </section>
        </div>
        {{-- Home Category content --}}
        <section class="home-category">
            <h1 class="title">shop by category</h1>
            <div class="box-container">

                <div class="box">
                    <img src="{{ url('assets/images/fruits-and-vegetable.jpg') }}" alt="" class="home-img">
                    <h3>Fruits/Vegitables</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                    <a href="" class="btn">More Info</a>
                </div>

                <div class="box">
                    <img src="{{ url('assets/images/meat-fish.jpg') }}" alt="" class="home-img">
                    <h3>Meat/Fish</h3>
                    <p>Indulge in the exquisite flavors of succulent meats and fresh catches from the sea.</p>
                    <a href="" class="btn">More Info</a>
                </div>

                <div class="box">
                    <img src="{{ url('assets/images/spice.jpg') }}" alt="" class="home-img">
                    <h3>Spice</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                    <a href="" class="btn">More Info</a>
                </div>

                <div class="box">
                    <img src="{{ url('assets/images/other ingredients.jpeg') }}" alt="" class="home-img">
                    <h3>Other Ingredients</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
                    <a href="" class="btn">More Info</a>
                </div>

            </div>
        </section>
        {{-- Products content --}}
        <section class="products">
            <h1 class="title">Latest Products</h1>
            <div class="box-container">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <form action="" class="box" method="POST">
                            <div class="price">${{ $product->price }}</div>
                            <a href="" class="fas fa-eye"></a>
                            <img src="{{ asset('uploadimg/' . $product->image) }}" alt="">
                            <div class="name">{{ $product->name }}</div>
                            <input type="hidden" name="pid" value="{{ $product->id }}">
                            <input type="hidden" name="p_name" value="{{ $product->name }}">
                            <input type="hidden" name="p_price" value="{{ $product->price }}">
                            <input type="hidden" name="p_image" value="{{ $product->image }}">
                            <input type="number" min="1" value="1" name="p_qty" class="qty">
                            <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                        </form>
                    @endforeach
                @else
                    <p class="empty">no products added yet!</p>
                @endif

            </div>
        </section>
        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
