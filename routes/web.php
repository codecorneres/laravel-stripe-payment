<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\InfoTableController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MoneySetupController;
use App\Http\Controllers\TagController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [InfoTableController::class ,'index'])->name('dashboard');

Route::get('/login', [userAuthController::class ,'index'])->name('login');
Route::post('/custom-login', [userAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('/registration', [userAuthController::class, 'registration'])->name('register-user');
Route::post('/custom-registration', [userAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [userAuthController::class, 'signOut'])->name('signout'); 

Route::get('/add', [InfoTableController::class ,'add'])->name('add');
Route::post('/insertDataSuccess', [InfoTableController::class ,'create'])->name('infoAdd');
Route::get('/edit/{id}', [InfoTableController::class ,'edit'])->name('edit');
Route::put('/update/{id}',[InfoTableController::class ,'update'])->name('update');
Route::get('/deleteData/{id}', [InfoTableController::class, 'destroy']);

Route::get('/posts', [PostsController::class ,'index'])->name('posts');
Route::get('/single/{id}',[PostsController::class ,'edit'])->name('single');
Route::put('/edit-post/{id}',[PostsController::class ,'update'])->name('edit-post');
Route::get('/add_post', [PostsController::class ,'add'])->name('add_post');
Route::post('/insertPostSuccess', [PostsController::class ,'create'])->name('addedPost');
Route::get('/deleteFile/{id}', [PostsController::class, 'deleteFile']);

Route::post('/comments', [CommentController::class ,'store'])->name('comment');


Route::get('paymentStripe', [MoneySetupController::class ,'paymentStripe'])->name('paymentStripe');
Route::post('paymentStripe', [MoneySetupController::class ,'postPaymentStripe'])->name('postPaymentStripe');

//Route::resource('/tags', TagController::class);
Route::get('tags', [TagController::class, 'index'])->name('tags');

// /tags, /tags/create, /tags (POST), /tags/$ID, /tags/$iD/edit, /tags/$id (PUT), /tags/$id (DELETE)


