<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\Category;
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
            'books' => Book::with('categories')->orderBy('id', 'desc')->paginate(10),
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
            $request->except('_token');
            Book::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'summary' => $request->input('summary'),
                'author' => $request->input('author'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'thumb' => $request->input('thumb'),
                'active' => $request->input('active'),
                'created_at' => Carbon::now('Asia/Ha_Noi')
            ]);
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
        return view('admin.book.edit', [
            'title' => 'Cập Nhật Truyện',
            'books' => Book::findOrFail($id),
            'name' => session()->get('email'),
            'categories' => Category::orderBy('id', 'desc')->get()
        ]);
    }

    public function update(BookRequest $request, $id)
    {
        try{
            $request->except('_token');
            $book = Book::findOrFail($id);
            $book->name = $request->input('name');
            $book->slug = $request->input('slug');
            $book->summary = $request->input('summary');
            $book->author = $request->input('author');
            $book->description = $request->input('description');
            $book->thumb = $request ->input('thumb');
            $book->category_id = $request ->input('category_id');
            $book->active = $request->input('active');
            $book->updated_at = Carbon::now('Asia/Ha_Noi');
            $book->save();
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
}
