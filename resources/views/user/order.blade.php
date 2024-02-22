</html>
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
        <section class="placed-orders">
            <h1 class="title">Placed Orders</h1>
            <div class="box-container">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div class="box">
                            <p> placed on : <span>{{ $order->placed_on }}</span> </p>
                            <p> name : <span>{{ $order->name }}</span> </p>
                            <p> number : <span>{{ $order->number }}</span> </p>
                            <p> email : <span>{{ $order->email }}</span> </p>
                            <p> address : <span>{{ $order->address }}</span> </p>
                            <p> payment method : <span>{{ $order->method }}</span> </p>
                            <p> your orders : <span>{{ $order->total_products }}</span> </p>
                            <p> total price : <span>${{ $order->total_price }}</span> </p>
                            <p> payment status : <span
                                    style="color: {{ $order->payment_status == 'pending' ? 'red' : 'orange' }}">{{ $order->payment_status }}</span>
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="empty">no orders placed yet!</p>
                @endif
            </div>
        </section>
        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
