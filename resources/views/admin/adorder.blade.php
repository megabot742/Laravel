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
        <section class="placed-orders">

            <h1 class="title">Placed Orders</h1>
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
                @foreach($orders as $order)
                   <div class="box">
                      <p> user id : <span>{{ $order->user_id }}</span> </p>
                      <p> placed on : <span>{{ $order->placed_on }}</span> </p>
                      <p> name : <span>{{ $order->name }}</span> </p>
                      <p> email : <span>{{ $order->email }}</span> </p>
                      <p> number : <span>{{ $order->number }}</span> </p>
                      <p> address : <span>{{ $order->address }}</span> </p>
                      <p> total products : <span>{{ $order->total_products }}</span> </p>
                      <p> total price : <span>${{ $order->total_price }}</span> </p>
                      <p> payment method : <span>{{ $order->method }}</span> </p>
                      <form action="{{ route('adorderupdate', $order->id) }}" method="POST">
                         @csrf
                         <input type="hidden" name="order_id" value="{{ $order->id }}">
                         <select name="update_payment" class="drop-down">
                            <option value="{{ $order->payment_status }}" selected disabled>{{ $order->payment_status }}</option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                         </select>
                         <div class="flex-btn">
                            <input type="submit" name="update_order" class="option-btn" value="update">
                            <a href="{{ route('adorderdelete', $order->id) }}" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                         </div>
                      </form>
                   </div>
                @endforeach
             
                @if(count($orders) == 0)
                   <p class="empty">no orders placed yet!</p>
                @endif
             </div>
        </section>

        <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
