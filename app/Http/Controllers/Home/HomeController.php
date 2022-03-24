<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home.pages.home', [
            'title' => 'Home',
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => Book::where('active', '=', 1)->orderBy('id', 'desc')->get()
        ]);
    }

    public function danhmuc($slug=''){
        $category_id = Category::where('slug', '=', $slug)->select('id')->first();
        $category_name = Category::where('slug', '=', $slug)->select('name')->first();
        return view('home.pages.category', [
            'title' => $category_name->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => Book::where('active', '=', 1)->where('category_id', '=', $category_id->id)->orderBy('id', 'desc')->get()
        ]);
    }

    public function doctruyen($slug=''){
        $n = Book::where('slug', '=', $slug)->first();
        $chapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'asc')->get();
        $update_chapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'desc')->first();
        $oneChapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'asc')->first();
        $lastChapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'desc')->first();
        $sameCate = Book::where('category_id', '=', $n->categories->id)->whereNotIn('id', [$n->id])->orderBy('id', 'desc')->get();
        return view('home.pages.book', [
            'title' => $n->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => Book::where('slug', '=', $slug)->first(),
            'chapters' => $chapter,
            'update_chapter' => $update_chapter,
            'sameCate' => $sameCate,
            'oneChapter' => $oneChapter,
            'lastChapter' => $lastChapter
        ]);
    }

    public function chapter($slug=''){
        $n = Chapter::where('slug', '=', $slug)->first();
        //breadcrumb
        $cateb = Book::where('id', '=', $n->book_id)->first();

        $chapter = Chapter::where('slug', '=', $slug)->where('book_id', '=', $n->book_id)->orderBy('id', 'desc')->first();
        $getAllChapters = Chapter::where('book_id', '=', $n->book_id)->orderBy('id', 'asc')->get();
        $next_chapter = Chapter::where('book_id', '=', $n->book_id)->where('id', '>', $chapter->id)->min('slug');
        $previous_chapter = Chapter::where('book_id', '=', $n->book_id)->where('id', '<', $chapter->id)->max('slug');
        return view('home.pages.chapter', [
            'title' => $n->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'chapter' => $chapter,
            'getAllChapters' => $getAllChapters,
            'nextChapter' => $next_chapter,
            'preChapter' => $previous_chapter,
            'cateb' => $cateb
        ]);
    }

    public function Search(){
        $keywords = $_GET['keyword'];
        $books = Book::where('name', 'LIKE', '%'. $keywords . '%')->orWhere('author', 'LIKE', '%'. $keywords . '%')->get();
        return view('home.pages.search', [
            'title' => "Tìm Kiếm",
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => $books,
        ]);
    }

    public function SearchAjax(Request $request){
        $html = "";
        $data = $request->all();
        if($data['keywords']){
            $book = Book::where('active', '=', 1)->where('name', 'LIKE', '%'. $data['keywords'] . '%')->get();
            $html .= "<ul class='dropdown-menu show' style='position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-213px, 40px, 0px);'>";

            foreach ($book as $b){
                $html .= "<li class='dropdown-item'>
                    <a style='text-decoration: none;' href='". route('doc-truyen', ['slug'=>$b->slug]) ."'>". $b->name . "</a>
                </li>";
            }
            $html .= "</ul>";

            return $html;
        }
    }
}
