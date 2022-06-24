<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Category_Book;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    public function index()
    {
        return view('admin.book.index', [
            'title' => 'Danh Sách Truyện',
            'books' => Book::with('book_in_multiple_cate')->orderBy('id', 'desc')->paginate(10),
            'name' => session()->get('email')
        ]);
    }

    public function storeImage(Request $request){
        dd($request->thumb);
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

    public function store(Request $request)
    {
        try{
            $book = new Book();
            $book->name = $request->name;
            $book->slug = $request->slug;
            $book->summary = $request->summary;
            $book->author = $request->author;
            $book->description = $request->description;
            if($request->thumb){
                $image = $request->thumb;
                $file = Storage::disk('public')->put('images', $image);
//                $file = Storage::put('images', $image, 'public');
                $book->thumb = 'storage/' . $file;
            }
            $book->hot_book = $request->hot_book;
            $book->active = $request->active;
            $book->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            foreach($request->categories as $category){
                $cate = $category[0];
            }
            $book->category_id = $cate;

            if($book->save()){
                $book->book_in_multiple_cate()->attach($request->categories);
                session()->flash('success', 'Thêm Truyện Thành Công');
                return redirect()->route('book.index');
            }
        }catch(\Exception $e){
            dd($e);
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

    public function update(Request $request, Book $book)
    {
        try{
            $data = $request->all();
            $book->name = $data['name'];
            $book->slug = $data['slug'];
            $book->summary = $data['summary'];
            $book->author = $data['author'];
            $book->description = $data['description'];
            $destination = public_path("storage\\" . $book->thumb);
            $fileName = "";
            if($request->hasFile('new_thumb')){
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $fileName = $request->file('new_thumb')->store('images', 'public');
                // $book->thumb = $path;
                $path = 'storage/' . $fileName;
            }else{
                $fileName = $book->thumb;
            }
            $book->thumb = $path;
            $book->hot_book = $data['hot_book'];
            $book->active = $data['active'];
            $book->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            foreach($data['categories'] as $category){
                $cate = $category[0];
            }
            $book->category_id = $cate;
            $book->save();
            $book->book_in_multiple_cate()->sync($data['categories']);
            return redirect()->route('book.index');
            // session()->flash('success', 'Cập Nhật Truyện Thành Công');
            // return redirect()->route('book.index');
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
    public function destroy(Request $request)
    {
        try{
            $book = Book::where('id', $request->id)->first();
            if($book){
                $book->delete();
                $bookThumb = str_replace('/storage/images/', '', $book->thumb);
                if(Storage::disk('public')->exists('images/' . $bookThumb)){
                    Storage::disk('public')->delete('images/' . $bookThumb);
                    return response()->json([
                        'message' => 'Deleted successfully',
                        'code' => 200
                    ]);
                }
            }
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
