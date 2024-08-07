<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ],
    [
      'title.required'=> 'Bạn không được để trống tiêu đề',
      'title.max' => 'Không được vượt quá 255 ký tự',
      'author.required'=> 'Không được để trống tác giả',
      'author.max'=> 'Không được vượt quá 255 ký tự',
      

    ]
  );
        $data = $request->except('thumbnail');
          $data['thumbnail']= "";
          if($request->hasFile('thumbnail')){
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnail');
          }
          Book::query()->create($data);
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
    public function update(Request $request, $id){
      $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ],
    [
      'title.required'=> 'Bạn không được để trống tiêu đề',
      'title.max' => 'Không được vượt quá 255 ký tự',
      'author.required'=> 'Không được để trống tác giả',
      'author.max'=> 'Không được vượt quá 255 ký tự',
      

    ]
  );
        $book = Book::query()->findOrFail($id);

        $data = $request->except('thumbnail');
          $data['thumbnail']= "";
          if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu có
            if ($book->thumbnail) {
                Storage::disk('public')->delete($book->thumbnail);
            }
    
            // Lưu ảnh mới
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $data['thumbnail'] = $book->thumbnail;
        }
          $book->update($data);
            return redirect()->back()->with('message', "Thêm dữ liệu thành công");
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
