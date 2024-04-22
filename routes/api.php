<?php

use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OurTeamController;
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
Route::post('register', [UserAuthController::class, 'userRegister']);
Route::post('login', [UserAuthController::class, 'userLogin']);
Route::post('logout', [UserAuthController::class, 'userlogout'])
    ->middleware('auth:sanctum');

//Login,Register
//user
Route::get('/usergetproducts', [ProductUserController::class, 'index']);
Route::get('/usergetproducts/{id}', [ProductUserController::class, 'show']);
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
Route::post('/add-to-cart', [ShoppingCartController::class, 'addToCart']);
Route::post('/updatecart', [ShoppingCartController::class, 'updateCart']);
Route::get('/add-to-cart-get-products', [ShoppingCartController::class, 'index']);
Route::delete('/add-to-cartdelete/{id}', [ShoppingCartController::class, 'deleteFromCart']);

//Order
//admin