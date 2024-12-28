<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Frontend\MasterController;
use App\Http\Controllers\Frontend\HumanController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberContronller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopeeBlogController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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






Route::group([
  'middleware' => ['member']
],function(){
    Route::get('/user',[MasterController::class,'index']);


});



//Frontend

Route::get('/user/register',[MasterController::class,'register']);
Route::post('/create-user/register',[MasterController::class,'create']);
Route::get('/user/login',[MasterController::class,'login']);
Route::post('/user/login',[MasterController::class,'checkLogin']);
Route::get('/logout',[MasterController::class,'logout']);


Route::get('/blog/{id}',[BlogController::class, 'blogDetail']);
Route::get('/blog',[BlogController::class, 'blog']);
Route::post('/blog/rate/ajax', [BlogController::class, 'ratingAjax']);
// Route::post('/blog/comment/{id}',[BlogController::class,'comment']);

Route::post('/blog/comment/ajax/{id}',[BlogController::class,'commentAjax']);
Route::get('/blog/comment/ajax/{id}',[BlogController::class,'listAjax']);

Route::get('/user/profile/{id}',[MemberController::class,'profile'],['showSidebar' => false]);
Route::post('/update/user/profile/{id}',[MemberController::class,'update']);

Route::get('/user/product/{id}',[ProductController::class,'product']);

Route::get('/create/product',[ProductController::class,'create']);

Route::post('/create/product',[ProductController::class,'store']);

Route::get('/update/product/{id}',[ProductController::class,'edit']);

Route::post('/update/product/{id}',[ProductController::class, 'update']);

Route::get('/product/detail/{id}', [ProductController::class, 'productDetail']);

Route::post('/product/cart',[ProductController::class, 'cart']);

Route::get('/cart/ajax/qty',[ProductController::class, 'Qty']);

Route::get('/cart',[ProductController::class, 'cartIndex'],['showSidebar' => false]);

Route::post('/ajax/cart/qtyup',[ProductController::class,'qtyUp']);

Route::post('/ajax/cart/qtydown',[ProductController::class,'qtyDown']);

Route::post('/ajax/cart/delete',[ProductController::class,'qtyDelete']);

Route::get('/checkout',[ProductController::class, 'checkout'],['showSidebar' => false]);

Route::post('/checkout',[ProductController::class , 'order']);

Route::post('/user',[MasterController::class, 'searchProduct']);

Route::get('/search/advanded/{param?}',[MasterController::class, 'searchAdvanced']);

Route::post('/search/advanded',[MasterController::class, 'resultsearchAdvanced']);

Route::post('/slider/price',[ProductController::class, 'sliderPrice']);

Route::get('/test',[MailController::class,'index']);



















//Admin
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => ['admin']
],function(){
    Route::get('', [DashboardController::class, 'index']);
Route::get('/country', [DashboardController::class, 'showCountry']);

// Route::get('/profile', [UserController::class, 'showProfile'])
Route::get('/profile/{id}',[UserController::class, 'edit']);
Route::post('/profile/{id}',[UserController::class, 'update']);

Route::get('/create-country',[DashboardController::class,'editCountry']);
Route::post('/create-country',[DashboardController::class,'storeCountry']);


Route::post('/delete-country/{id}',[DashboardController::class,'deleteCountry']);

Route::get('/shopee-blog',[ShopeeBlogController::class,'index']);

Route::get('/create-shopee-blog',[ShopeeBlogController::class,'create']);

Route::post('/create-shopee-blog',[ShopeeBlogController::class,'store']);


Route::get('/update-shopee-blog/{id}',[ShopeeBlogController::class,'editShopeeBlog']);


Route::post('/update-shopee-blog/{id}',[ShopeeBlogController::class,'updateShopeeBlog']);

Route::post('/delete-shopee-blog/{id}',[ShopeeBlogController::class,'deleteShopeeBlog']);

Route::get('/category',[CategoryController::class,'category']);

Route::get('/create/category',[CategoryController::class,'create']);

Route::post('/create/category',[CategoryController::class,'store']);

Route::post('/delete/category/{id}',[CategoryController::class,'delete']);

Route::get('/brand',[BrandController::class,'brand']);

Route::get('/create/brand',[BrandController::class,'create']);

Route::post('/create/brand',[BrandController::class,'store']);

Route::post('/delete/brand/{id}',[BrandController::class,'deleteBrand']);



});


























