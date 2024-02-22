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
    <link rel="stylesheet" href="{{ url('assets/css/admin_style.css') }}">

</head>

<body>
    @extends('admin.adapp')
    @section('adcontent')
        <section class="add-products">

            <h1 class="title">Add new product</h1>

            <form action="adproduct" method="POST" enctype="multipart/form-data">
                @csrf
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
                <div class="flex">
                    <div class="inputBox">
                        <input type="text" name="name" class="box" required placeholder="enter product name">
                        <select name="category" class="box" required>
                            <option value="" selected disabled>Select Category</option>
                            <option value="Fruits and Vegetable">Fruits and Vegetable</option>
                            <option value="Meat and Fish">Meat and Fish</option>
                            <option value="Spice">Spice</option>
                            <option value="Other Ingredients">Other Ingredients</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <input type="number" min="0" name="price" class="box" required
                            placeholder="enter product price">
                        <input type="file" name="image" required class="box"
                            accept="image/jpg, image/jpeg, image/png">
                    </div>
                </div>
                <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
                <input type="submit" class="btn" value="add product" name="add_product">
            </form>

        </section>

        <section class="show-products">

            <h1 class="title">Products added</h1>
            <div class="box-container">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="box">
                            <div class="price">${{ $product->price }}</div>
                            <img src="{{ asset('uploadimg/' . $product->image) }}" alt="">
                            <div class="name">{{ $product->name }}</div>
                            <div class="cat">{{ $product->category }}</div>
                            <div class="details">{{ html_entity_decode($product->details) }}</div>
                            <div class="flex-btn">
                                <a href="{{ route('adproductupdate', ['id' => $product->id]) }}" class="option-btn">Update</a>
                                <a href="{{ route('adproductdelete', ['id' => $product->id]) }}" class="delete-btn"
                                    onclick="return confirm('Delete this product?');">Delete</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="empty">No products added yet!</p>
                @endif
            </div>
        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
