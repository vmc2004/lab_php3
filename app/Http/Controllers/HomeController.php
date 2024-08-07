<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
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
    }
    public function admin(){
        $totalBook = count(Book::all());
        $totalUser = count(User::all());
        $totalCategory = count(Category::all());
        $tbPrice = Book::avg('price');
        return view('admin.home', compact('totalBook','totalUser','totalCategory','tbPrice'));
    }
}
