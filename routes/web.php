<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

Route::get('/', function () {
    $books = DB::table('books')
    ->limit(8)
    ->orderByDesc('price')
   ->get();

   $thap = DB::table('books')
   ->limit(8)
   ->orderBy('price')
  ->get();
  $cate = DB::table('categories')->get();
    return view('home', compact('books', 'thap' , 'cate'));

})->name('index');
Route::get('/search', [BookController::class, 'search'])->name('search');
Route::resource('category', CategoryController::class);
Route::resource('book', BookController::class);
Route::get('dashboard', function(){
    return view('admin.home');
})->name('admin');


Route::get('/cart', function(){
    return view('cart.view');
});
Route::get('/sigin', [LoginController::class, 'showLoginForm'])->name('sigin');
Route::post('/sigin', [LoginController::class, 'Login'])->name('sigin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
Route::put('/update/profile/{id}', [UserController::class,'update'])->name('update.profile');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
