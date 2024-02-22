<?php

use App\Http\Controllers\AdContactController;
use App\Http\Controllers\AdHomeController;
use App\Http\Controllers\AdOrderController;
use App\Http\Controllers\AdProductController;
use App\Http\Controllers\AdProductUpdateController;
use App\Http\Controllers\AdprofileController;
use App\Http\Controllers\AdUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\ViewpageController;
use App\Http\Controllers\WishlisttController;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Register
Route::get('/register', [RegisterController::class, 'RegisterIndex']);
Route::post('/register', [RegisterController::class, 'RegisterCheck']);
// Login
Route::get('/login', function () {
    if (session()->has('user_id')) {
        return redirect('');
    }
    return view('login');
});
Route::post('/login', [LoginController::class, 'LoginCheck']);
// Logout
Route::get('/logout', function () {
    if (session()->has('user_id')) {
        session()->pull('user_id', 'username', 'useremail', 'userimage', 'userpass');
    }
    return redirect('login');
});
//-----------ForAdmin---------------
// Login
Route::get('/login', function () {
    if (session()->has('ad_id')) {
        return redirect('adhome');
    }
    return view('login');
});
// Logout
Route::get('/adlogout', function () {
    if (session()->has('ad_id')) {
        session()->pull('ad_id', 'adname', 'ademail', 'adimage', 'adpass');
    }
    return redirect('login');
});


//--------------------Admin-----------------
//AdHome
Route::get('/adhome', [AdHomeController::class, 'indexHome']);
//Adproduct 
Route::get('/adproduct', [AdProductController::class, 'indexProduct']);
Route::post('/adproduct', [AdProductController::class, 'addProduct']);
Route::get('/adproductdelete/{id}', [AdProductController::class, 'deleteProduct'])->name('adproductdelete');
//AdproductUpdate
Route::get('/adproductupdate/{id}', [AdProductUpdateController::class, 'viewProduct'])->name('adproductupdate');
Route::post('/adproductupdate/{id}', [AdProductUpdateController::class, 'updateProduct']);
//AdOrder
Route::get('/adorder', [AdOrderController::class, 'indexOrder']);
Route::post('/adorderupdate/{id}', [AdOrderController::class, 'updateOrder'])->name('adorderupdate');
Route::get('/adorderdelete/{id}', [AdOrderController::class, 'deleteOrder'])->name('adorderdelete');
//Adprofile
Route::get('/adprofile', [AdprofileController::class, 'ViewIndexAd']);
Route::post('/adprofile', [AdprofileController::class, 'ViewCheckAd']);
//Aduser
Route::get('/aduser', [AdUserController::class, 'indexUser']);
Route::get('/aduser/{id}', [AdUserController::class, 'deleteUser'])->name('adouser');
//Adcontact
Route::get('/adcontact', [AdContactController::class, 'indexContact']);
Route::get('/adcontact/{id}', [AdContactController::class, 'deleteContact'])->name('adcontact');



//--------------------User-------------------
//Home
Route::get('/', [HomeController::class, 'indexProducts']);
//Shop
Route::get('/shop', [ShopController::class, 'indexProducts']);
Route::post('/shop', [ShopController::class, 'addProducts']);
//Cart
Route::get('/cart', [CartController::class, 'showCart']);
Route::post('/cart', [CartController::class, 'updateCart']);
Route::get('/cartdelete/{id}', [CartController::class, 'deleteCart'])->name('cartdelete');
Route::get('/cartdelete_all', [CartController::class, 'deleteAllCart'])->name('cartdelete_all');
//Wishlist
Route::get('/wishlist', [WishlisttController::class, 'indexWishlist']);
Route::post('/wishlist', [WishlisttController::class, 'addtoCart']);
Route::get('/wishlistdelete/{id}', [WishlisttController::class, 'delete'])->name('wishlistdelete');
Route::get('/wishlistdelete_all', [WishlisttController::class, 'deleteAll'])->name('wishlistdelete_all');
//Userprofile
Route::get('/userprofile', [UserprofileController::class, 'ViewIndex']);
Route::post('/userprofile', [UserprofileController::class, 'ViewCheck']);
//Order
Route::get('/order', [OrderController::class, 'placedOrders']);
//Search
Route::get('/search', [SearchController::class, 'Viewsearch']);
Route::post('/search', [SearchController::class, 'FindSearch']);
//About
Route::get('/about', function () {
    return view('user.about');
});
//Contact
Route::get('/contact', [ContactController::class, 'viewContact']);
Route::post('/contact', [ContactController::class, 'sendMessage']);
//Viewpage
Route::get('/viewpage/{id}', [ViewpageController::class, 'quickView']);
Route::post('/viewpage/{id}', [ViewpageController::class, 'addView']);
//Category
Route::get('/products/{category}', [CategoryController::class, 'productsByCategory'])->name('products-by-category');
Route::post('/products/{category}', [CategoryController::class, 'addProductsByCategory'])->name('add-products-by-category');

//Checkout  
Route::get('/checkout', [CheckoutController::class, 'viewcheckout']);
Route::post('/checkout', [CheckoutController::class, 'applycheckout']);
//Paymen online
