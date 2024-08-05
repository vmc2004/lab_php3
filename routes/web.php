<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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


// Search 
Route::get('/search', [BookController::class, 'search'])->name('search');
// End search
Route::get('/cart', function(){
    return view('cart.view');
});
// Login and Register

Route::get('/sigin', [LoginController::class, 'showLoginForm'])->name('sigin');
Route::post('/sigin', [LoginController::class, 'Login'])->name('sigin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
Route::put('/update/profile/{id}', [UserController::class,'update'])->name('update.profile');
Route::put('hidden/user/{id}',[UserController::class,'hidden'])->name('hidden.user');
Route::put('show/user/{id}',[UserController::class,'show'])->name('show.user');
Route::get('changePassword/{id}',[UserController::class,'change'])->name('change.password');
Route::put('changePassword/{id}',[UserController::class,'updatePassword']);

// End login and register 

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('category', CategoryController::class);
Route::resource('book', BookController::class);


// Admin 

Route::prefix('admin')
    ->as('admin.')
    ->group(function() {
        Route::get('/', [HomeController::class,'index'])->name('index');
        
        Route::prefix('/book')
            ->as('book.')
            ->group(function() {
                Route::get('/create', [BookController::class, 'create'])->name('create');
                Route::get('/', [BookController::class, 'index'])->name('index');
                Route::post('/store', [BookController::class, 'store'])->name('store');
                Route::get('/show/{id}', [BookController::class, 'show'])->name('show');
                Route::get('{id}/edit', [BookController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BookController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [BookController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('/category')
            ->as('category.')
            ->group(function() {
                Route::get('/', [CategoryController::class, 'index2'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::post('/store', [CategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('/user')
        ->as('user.')
        ->group(function(){
            Route::get('/', [UserController::class,'index'])->name('index');
            Route::put('{id}/unhidden', [UserController::class,'unhidden'])->name('unhidden');
            Route::put('{id}/hidden', [UserController::class,'hidden'])->name('hidden');
            Route::get('show/{id}', [UserController::class,'show'])->name('show');
            Route::get('create', [UserController::class,'create'])->name('create');
            Route::get('store', [UserController::class,'store'])->name('store');
            Route::get('{id}/edit', [UserController::class,'edit'])->name('edit');
            Route::get('{id}/update', [UserController::class,'update'])->name('update');
            Route::delete('{id}/destroy', [UserController::class,'destroy'])->name('destroy');
        });

    });
// end Admin 