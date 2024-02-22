<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genshin Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    
</head>

<body>
    @extends('app')
    @section('content')
    <section class="about">

        <div class="row">
     
           <div class="box">
              <img src="{{ url('assets/images/about-img-1.png') }}" alt="">
              <h3>Why choose us?</h3>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
              <a href="{{ url('/contact') }}" class="btn">contact us</a>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/about-img-2.png') }}" alt="">
              <h3>What we provide?</h3>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
              <a href="{{ url('/shop') }}" class="btn">our shop</a>
           </div>
     
        </div>
     
     </section>
     
     <section class="reviews">
     
        <h1 class="title">clients reivews</h1>
     
        <div class="box-container">
     
           <div class="box">
              <img src="{{ url('assets/images/pic-1.png') }} " alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/pic-2.png') }}" alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/pic-3.png') }} " alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/pic-4.png') }} " alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/pic-5.png')}}  " alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
           <div class="box">
              <img src="{{ url('assets/images/pic-6.png')}} " alt="">
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
              <div class="stars">
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
              </div>
              <h3>john deo</h3>
           </div>
     
        </div>
     
     </section> 
     <script src="{{ url('assets/js/script.js') }}"></script>
    @endsection
</body>

</html>
