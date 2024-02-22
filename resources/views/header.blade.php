<header class="header">

    <div class="flex">

        <a href="{{ url('/') }}" class="logo">Genshin Store<span>.</span></a>

        <nav class="navbar">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/shop') }}">Shop</a>
            <a href="{{ url('/order') }}">Order</a>
            <a href="{{ url('/about') }}">About</a>
            <a href="{{ url('/contact') }}">Contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            $user_id = session('user_id');
            $count_cart_items = DB::table('cart')
                ->where('user_id', $user_id)
                ->count();
            $count_wishlist_items = DB::table('wishlist')
                ->where('user_id', $user_id)
                ->count();
            ?>
            <a href="{{ url('/search') }}" class="fas fa-search"></a>
            <a href="{{ url('/wishlist') }}"><i class="fas fa-heart"></i>
                <span>
                    ({{ $count_wishlist_items }})
                </span>
            </a>
            <a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart">
                </i>
                <span>
                  ({{ $count_cart_items }})
                </span>
            </a>
        </div>

        <div class="profile">
            <img src="uploadimg/{{ session('userimage') }}" alt="">
            <p>{{ session('username') }}</p>
            <a href="{{ url('/userprofile') }}" class="btn">Update Profile</a>
            <a href="{{ url('/logout') }}" class="delete-btn">Logout</a>
            <div class="flex-btn">
                <a href="{{ url('/login') }}" class="option-btn">Login</a>
                <a href="{{ url('/register') }}" class="option-btn">Register</a>
            </div>
        </div>

    </div>

</header>
