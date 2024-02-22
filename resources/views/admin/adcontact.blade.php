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
        <section class="messages">
            <h1 class="title">Messages Contact</h1>
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
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <div class="box">
                            <p> user id : <span>{{ $message->user_id }}</span></p>
                            <p> name : <span>{{ $message->name }}</span> </p>
                            <p> number : <span>{{ $message->number }}</span> </p>
                            <p> email : <span>{{ $message->email }}</span> </p>
                            <p> message : <span>{{ $message->message }}</span> </p>
                            <a href="{{ route('adcontact', $message->id) }}" class="delete-btn"
                                onclick="return confirm('Delete This User?');">Delete</a>
                        </div>
                    @endforeach
                @else
                    <p class="empty">You have no messages!</p>
                @endif
            </div>

        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
