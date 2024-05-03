<?php

use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\user\ProductUserController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Login,Register
/* Api Register */
Route::get('/users', [UserAuthController::class, 'index']);
Route::get('/getusers/{id}', [UserAuthController::class, 'show']);
Route::post('/register', [UserAuthController::class, 'userRegister']);
Route::post('/login', [UserAuthController::class, 'userLogin']);
Route::post('/logout', [UserAuthController::class, 'userlogout'])
    ->middleware('auth:sanctum');

//Update User Profile
Route::post('/update/{id}', [UserAuthController::class, 'userUpdate']);
Route::post('/avatar/{id}', [UserAuthController::class, 'userAvatar']);
//Update User Profile

//Login,Register

//Payment
Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
//Payment

//user
Route::get('/usergetproducts', [ProductUserController::class, 'index']);
Route::get('/usergetproducts/{id}', [ProductUserController::class, 'show']);
//user


//admin
//Product
Route::get('/getproducts', [ProductAdminController::class, 'index']);
Route::post('/addproducts', [ProductAdminController::class, 'store']);
// Route::get('/updateproducts/{id}', [ProductAdminController::class, 'show']);
Route::post('/updateproducts/{id}', [ProductAdminController::class, 'update']);
Route::delete('/products/{id}', [ProductAdminController::class, 'destroy']);
//Product

//Blog
Route::get('/getblog', [BlogController::class, 'index']);
Route::post('/addblog', [BlogController::class, 'store']);
// Route::get('/updateblog/{id}', [BlogController::class, 'show']);
Route::post('/updateblog/{id}', [BlogController::class, 'update']);
Route::delete('/blog/{id}', [BlogController::class, 'destroy']);
//Blog

//OurTeam
Route::get('/getourteam', [OurTeamController::class, 'index']);
Route::post('/addourteam', [OurTeamController::class, 'store']);
// Route::get('/updateblog/{id}', [OurTeamController::class, 'show']);
Route::post('/updateourteam/{id}', [OurTeamController::class, 'update']);
Route::delete('/ourteam/{id}', [OurTeamController::class, 'destroy']);
//OurTeam

//Order
Route::post('/add-to-cart', [ShoppingCartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::post('/updatecart', [ShoppingCartController::class, 'updateCart']);
Route::get('/add-to-cart-get-products', [ShoppingCartController::class, 'index'])->middleware('auth:sanctum');
Route::delete('/add-to-cartdelete/{id}', [ShoppingCartController::class, 'deleteFromCart']);

Route::get('/order', [OrderController::class, 'index']);
Route::post('/placeorder', [OrderController::class, 'store']);

// Route::post('/orderproducts', [OrderProductController::class, 'store']);

//Order
//admin