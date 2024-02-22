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
        <section class="user-accounts">
            <h1 class="title">user accounts</h1>
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
                @foreach ($users as $user)
                    @if ($user->id != session('ad_id'))
                        <div class="box">
                            <img src="{{ asset('uploadimg/' . $user->image) }}" alt="">
                            <p> user id: <span>{{ $user->id }}</span></p>
                            <p> username: <span>{{ $user->name }}</span></p>
                            <p> email: <span>{{ $user->email }}</span></p>
                            <p> user type: <span
                                    style="color: {{ $user->user_type == 'admin' ? 'orange' : '' }}">{{ $user->user_type }}</span>
                            </p>
                            <a href="{{ route('adouser', $user->id) }}" class="delete-btn"
                                onclick="return confirm('Delete This User?');">Delete</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
