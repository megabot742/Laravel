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
        <section class="contact">
            <h1 class="title">Send Message For Us</h1>
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
            <form action="contact" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" class="box" required placeholder="enter your name">
                <input type="email" name="email" class="box" required placeholder="enter your email">
                <input type="number" name="number" min="0" class="box" required placeholder="enter your number">
                <textarea name="msg" class="box" required placeholder="enter your message" cols="30" rows="10"></textarea>
                <input type="submit" value="send message" class="btn" name="send">
            </form>
        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
