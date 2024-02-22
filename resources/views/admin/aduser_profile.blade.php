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
        <section class="update-profile">

            <h1 class="title">Update Profile</h1>

            <form action="adprofile" method="POST" enctype="multipart/form-data">
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
                <img src="uploadimg/{{ session('adimage') }}" alt="">
                <div class="flex">
                    <div class="inputBox">
                        <span>Username :</span>
                        <input type="text" name="name" value="{{ session('adname') }}" placeholder="update username"
                            required class="box">
                        <span>Email :</span>
                        <input type="email" name="email" value="{{ session('ademail') }}" placeholder="update email"
                            required class="box">
                        <span>Update pic :</span>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
                        <input type="hidden" name="old_image" value="{{ session('adimage') }}">
                    </div>
                    <div class="inputBox">
                        <input type="hidden" name="old_pass" value="{{ session('adpass') }}">
                        <span>Old password :</span>
                        <input type="password" name="update_pass" placeholder="enter previous password" class="box">
                        <span>New password :</span>
                        <input type="password" name="new_pass" placeholder="enter new password" class="box">
                        <span>Confirm password :</span>
                        <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
                    </div>
                </div>
                <div class="flex-btn">
                    <input type="submit" class="btn" value="update profile" name="update_profile">
                    <a href="{{ url('/adhome') }}" class="option-btn">Go Back</a>
                </div>
            </form>

        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
