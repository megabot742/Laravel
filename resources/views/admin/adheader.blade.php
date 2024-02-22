<header class="header">

    <div class="flex">
 
       <a href="{{ url('/adhome') }}" class="logo">Admin<span>Panel</span></a>
 
       <nav class="navbar">
          <a href="{{ url('/adhome') }}">Home</a>
          <a href="{{ url('/adproduct') }}">Products</a>
          <a href="{{ url('/adorder') }}">Orders</a>
          <a href="{{ url('/aduser') }}">Users</a>
          <a href="{{ url('/adcontact') }}">Messages</a>
       </nav>
 
       <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="user-btn" class="fas fa-user"></div>
       </div>

       <div class="profile">
         <img src="uploadimg/{{ session('adimage') }}" alt="">
         <p>{{ session('adname') }}</p>
        <a href="{{ url('/adprofile') }}" class="btn">Update Profile</a>
        <a href="{{ url('/adlogout') }}" class="delete-btn">Logout</a>
        <div class="flex-btn">
           <a href="{{ url('/login') }}" class="option-btn">Login</a>
           <a href="{{ url('/register') }}" class="option-btn">Register</a>
        </div>
     </div>
 
    </div>
 
 </header>
