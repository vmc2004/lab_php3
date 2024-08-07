<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show($id){
        $cate = DB::table('categories')
        ->where('id', $id)
        ->first();
        $books = DB::table('books')
        ->where('Category_id', $id)
        ->paginate(9);
        return view('shop', compact('cate', 'books'));
    }
    public function index(){
        $books = DB::table('books')
        ->paginate(9);
        
        return view('shop' , compact('books'));
    }
    public function index2(){
        $categories = Category::query()->paginate(6);
        return view('admin.Categories.List', compact('categories'));
    }
    public function create(){
        return view('admin.Categories.Create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
            
        ],
        [
          'name.required'=> 'Bạn không được để trống tên danh mục',
          
          
    
        ]
      );
   $data =$request->only(['name']);
    
        // Lưu dữ liệu vào cơ sở dữ liệu
        Category::create($data);
    
        // Chuyển hướng và hiển thị thông báo
        return redirect()->route('admin.category.index')->with('message', 'Thêm mới thành công');
    }
    
    public function destroy($id){
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('message', 'Xóa thành công thành công');

    }
    public function edit($id){
        $category = Category::query()->findOrFail($id);
        return view('admin.Categories.Edit', compact('category'));
    }
    public function update(Request $request, $id){
        $data = $request->only(['name']);
        $category = Category::query()->findOrFail($id);
        $category->update($data);
        return redirect()->back()->with('message', 'Cập nhật công thành công');
    }

}
