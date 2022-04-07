<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Category_Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index', [
            'title' => 'Danh Sách Truyện',
            'books' => Book::with('book_in_multiple_cate')->orderBy('id', 'desc')->paginate(10),
            'name' => session()->get('email')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.add', [
            'title' => 'Thêm Mới Truyện',
            'name' => session()->get('email'),
            'categories' => Category::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(BookRequest $request)
    {
        try{
            $book = new Book();
            $data = $request->all();
            $book->name = $data['name'];
            $book->slug = $data['slug'];
            $book->summary = $data['summary'];
            $book->author = $data['author'];
            $book->description = $data['description'];
            $book->thumb = $data['thumb'];
            $book->hot_book = $data['hot_book'];
            $book->active = $data['active'];
            $book->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            foreach($data['categories'] as $category){
                $cate = $category[0];
            }
            $book->category_id = $cate;
            $book->save();
            $book->book_in_multiple_cate()->attach($data['categories']);
            session()->flash('success', 'Thêm Truyện Thành Công');
            return redirect()->route('book.create');
        }catch(\Exception $e){
            session()->flash('error', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $byCates = $book->book_in_multiple_cate;
        return view('admin.book.edit', [
            'title' => 'Cập Nhật Truyện',
            'books' => Book::findOrFail($id),
            'name' => session()->get('email'),
            'categories' => Category::orderBy('id', 'desc')->get(),
            'byCates' => $byCates
        ]);
    }

    public function update(BookRequest $request, $id)
    {
        try{
            $request->except('_token');
            $book = Book::findOrFail($id);
            $data = $request->all();
            $book->name = $data['name'];
            $book->slug = $data['slug'];
            $book->summary = $data['summary'];
            $book->author = $data['author'];
            $book->description = $data['description'];
            $book->thumb = $data['thumb'];
            $book->hot_book = $data['hot_book'];
            $book->active = $data['active'];
            $book->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            foreach($data['categories'] as $category){
                $cate = $category[0];
            }
            $book->category_id = $cate;
            $book->save();
            $book->book_in_multiple_cate()->sync($data['categories']);
            session()->flash('success', 'Cập Nhật Truyện Thành Công');
            return redirect()->route('book.index');
        }catch(\Exception $e){
            session()->flash('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $book = Book::findOrFail($id);
            $bookThumb = str_replace('/webtruyen/storage/app/public/uploads/', '', $book->thumb);
            if(Storage::disk('public')->exists('uploads/' . $bookThumb)){
                $book->delete();
                Storage::disk('public')->delete('uploads/' . $bookThumb);
            }
            session()->flash('success', 'Xóa Thành Công');
            return redirect()->route('book.index');
        }catch(\Exception $e){
            session()->flash('error', $e);
        }
    }

    public function featuredBooks(Request $request){
        $data = $request->all();
        $book = Book::findOrFail($data['hot_book_id']);
        $book->hot_book = $data['hot_books'];
        $book->save();
    }
}
