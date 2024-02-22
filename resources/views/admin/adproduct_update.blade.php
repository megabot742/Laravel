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
        <section class="update-product">

            <h1 class="title">Update Product</h1>

            <form action="{{ url('adproductupdate', ['id' => $products->id]) }}" method="post"
                enctype="multipart/form-data">
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
                <input type="hidden" name="old_image" value="{{ $products->image }}">
                <input type="hidden" name="pid" value="{{ $products->id }}">
                <img src="{{ asset('uploadimg/' . $products->image) }}" alt="">
                <input type="text" name="name" placeholder="Enter product name" required class="box"
                    value="{{ $products->name }}">
                <input type="number" name="price" min="0" placeholder="Enter product price" required
                    class="box" value="{{ $products->price }}">
                <select name="category" class="box" required>
                    <option selected>{{ $products->category }}</option>
                    <option value="Fruits and Vegetable">Fruits and Vegetable</option>
                    <option value="Meat and Fish">Meat and Fish</option>
                    <option value="Spice">Spice</option>
                    <option value="Other Ingredients">Other Ingredients</option>
                </select>
                <textarea name="details" required placeholder="Enter product details" class="box" cols="30" rows="10">{{ html_entity_decode($products->details) }}</textarea>
                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
                <div class="flex-btn">
                    <input type="submit" class="btn" value="Update Product" name="update_product">
                    <a href="{{ url('adproduct') }}" class="option-btn">Go Back</a>
                </div>
            </form>

        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
