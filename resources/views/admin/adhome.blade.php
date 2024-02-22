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
        <section class="dashboard">

            <h1 class="title">dashboard</h1>

            <div class="box-container">

                <div class="box">
                    <h3>${{ $total_pendings }}</h3>
                    <p>Total Pendings</p>
                    <a href="{{ url('/adorder') }}" class="btn">See Orders</a>
                </div>

                <div class="box">
                    <h3>${{ $total_completed }}</h3>
                    <p>Completed Orders</p>
                    <a href="{{ url('/adorder') }}" class="btn">See Orders</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_orders }}</h3>
                    <p>Orders Placed</p>
                    <a href="{{ url('/adorder') }}" class="btn">See Orders</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_products }}</h3>
                    <p>Products Added</p>
                    <a href="{{ url('/adproduct') }}" class="btn">See Products</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_users }}</h3>
                    <p>Total Users</p>
                    <a href="{{ url('/aduser') }}" class="btn">See Accounts</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_admins }}</h3>
                    <p>Total Admins</p>
                    <a href="{{ url('/aduser') }}" class="btn">See Accounts</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_accounts }}</h3>
                    <p>Total Accounts</p>
                    <a href="{{ url('/aduser') }}" class="btn">See Accounts</a>
                </div>

                <div class="box">
                    <h3>{{ $number_of_messages }}</h3>
                    <p>Total Messages</p>
                    <a href="{{ url('/adcontact') }}" class="btn">see messages</a>
                </div>

            </div>

        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
