<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\DB;
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

});

Route::get('/shop', function () {
    $books = DB::table('books')
    ->get();
    
    return view('shop' , compact('books'));
});
Route::get('/cate-book/{id}', function($id){
    $cate = DB::table('categories')
    ->where('id', $id)
    ->first();
    $books = DB::table('books')
    ->where('Category_id', $id)
    ->get();
    return view('shop', compact('cate', 'books'));
});
Route::get('/detail-book/{id}', function($id){
   $book = DB::table('books')
   ->where('id', $id)
   ->first();
    return view('detailBook', compact('book'));
});
Route::get('dashboard', function(){
    return view('admin.home');
});
Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/create-book', [BookController::class, 'create'])->name('book.create');
Route::post('/create-book', [BookController::class, 'store'])->name('book.store');
Route::get('/edit-book/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('/update-book/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('delete-book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
