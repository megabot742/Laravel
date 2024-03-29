<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genshin Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    
</head>

<body>
    <section class="form-container">

        <form action="register" enctype="multipart/form-data" method="POST">
            @csrf
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            @if (session()->has('messagedone'))
                <div class="alert alert-success">
                    <strong>{{ session('messagedone') }}</strong>
                </div>
            @endif
           <h3>Register Now</h3>
           <input type="text" name="name" class="box" placeholder="enter your name" required>
           <input type="email" name="email" class="box" placeholder="enter your email" required>
           <input type="password" name="pass" class="box" placeholder="enter your password" required>
           <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
           <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
           <input type="submit" value="register now" class="btn" name="submit">
           <p>Already have an account? <a href="{{ url('/login') }}">Login Now</a></p>
        </form>
     
     </section>
</body>

</html>
