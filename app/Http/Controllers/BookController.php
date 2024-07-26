<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;

use function Ramsey\Uuid\v1;

class BookController extends Controller
{
    public function index(){
        $books = Book::orderByDesc('id')->paginate(5);

        return view('admin.Books.List', compact('books'));
    }
    public function create(){
        $categories = Category::all();
      return view('admin.Books.Create',compact('categories'));
    }
    public function store(Request $request){
            $data = $request->except('thumbnail');
            $data['thumbnail']= "";
            if($request->hasFile('thumbnail')){
                
                $path_image = $request->file('thumbnail')->store('public/images');
        
        // Lưu đường dẫn của file vào mảng dữ liệu
        $data['thumbnail'] = str_replace('public/', 'storage/', $path_image);
            }
            Book::create($data);
            return redirect()->route('book.index')->with('message', "Thêm dữ liệu thành công");
    }
    public function destroy($id){
        DB::table('books')->delete($id);
        return redirect()->route('book.index');
    }
    public function edit($id){
       $book =  DB::table('books')->where('id', $id)->first();
       $categories = DB::table('categories')->get();
       return view('admin.Books.Edit', compact('book', 'categories'));
    }
    public function update(Request $request){
        $data = [
            'title'=> $request['title'],
            'thumbnail'=> $request['thumbnail'],
            'author'=> $request['author'],
            'publisher'=> $request['publisher'],
            'publication'=> $request['publication'],
            'price'=> $request['price'],
            'quantity'=> $request['quantity'],
            'category_id'=> $request['category_id']
        ];
        DB::table('books')
        ->where('id', $request['id'])
        ->update($data);
        return redirect()->route('book.index');
    }
    public function show($id){
        $book = DB::table('books')
           ->where('id', $id)
           ->first();
            return view('detailBook', compact('book'));
    }
    public function search(Request $request)
    {
        $books = Book::query()->where('title', 'LIKE', '%'. $request->input('search').'%')
            ->paginate(9);

        return view('shop', compact('books'));
    }
}
