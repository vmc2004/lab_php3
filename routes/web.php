<?php

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