<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Category_Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(){
        $books = Book::where('active', '=', 1)->orderBy('id', 'desc')->get();
        $cate = Category::where('active', '=', 1)->orderBy('id', 'desc')->get();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        return view('home.pages.home', [
            'title' => 'Home',
            'categories' => $cate,
            'books' => $books,
            'slides' => $slides
        ]);
    }

    //filter
    public function filteredChar($char = '', Request $request){
        $books = Book::where('active', '=', 1)->where('name', 'LIKE', '%'. $char . '%')->orderBy('id', 'desc')->paginate(15);
        $cate = Category::where('active', '=', 1)->orderBy('id', 'desc')->get();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        return view('home.pages.fillter', [
            'title' => 'Home',
            'categories' => $cate,
            'books' => $books,
            'slides' => $slides
        ]);
    }

    //tabCate
    public function tabCate(Request $request){
        $html = "";
        if($request->ajax()){
            $data = $request->all();
            $book_cate = Category::with('bookss')->where('id', '=', $data['id'])->get();
            foreach ($book_cate as $book){
                foreach($book->bookss as $book_){
                    $html .= "<div class='col'>
                    <div class='card shadow-sm'>
                        <a href='". route('doc-truyen', ['slug'=>$book_->slug]) ."'><img class='card-img-top' width='80px' src='". $book_->thumb ."' alt=''></a>
                      <div class='card-body'>
                          <h5>". $book_->name ."</h5>
                        <div class='card-text'>
                        <div class='card-text'>$book_->summary</div>
                        </div>
                        <div style='width: 100%;' class='mt-2 d-flex justify-content-between'>
                          <a href='' class='btn btn-sm btn-outline-secondary'><i class='fa-solid fa-eye'></i> ". $book_->views ."</a>
                          <a href='". route('doc-truyen', ['slug'=>$book_->slug]) ."' class='btn btn-sm btn-outline-secondary'>Đọc Ngay</a>
                          <small class='mp-2 d-flex justify-content-center text-muted'>Cập Nhật: ". $book_->updated_at->diffForHumans() ."</small>
                        </div>
                      </div>
                    </div>
                  </div>";
                }
            }

        }

        return $html;
    }

    public function danhmuc($slug=''){
        $category_id = Category::where('slug', '=', $slug)->select('id')->first();
        $category_name = Category::where('slug', '=', $slug)->select('name')->first();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        $books = Book::where('active', '=', 1)->where('category_id', '=', $category_id->id)->orderBy('id', 'desc')->get();
        return view('home.pages.category', [
            'title' => $category_name->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => $books,
            'slides' => $slides,
            'cates' => Category::where('slug', '=', $slug)->first()
        ]);
    }

    public function doctruyen($slug=''){
        $n = Book::where('slug', '=', $slug)->first();
        $chapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'asc')->get();
        $update_chapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'desc')->first();
        $oneChapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'asc')->first();
        $lastChapter = Chapter::where('book_id', '=', $n->id)->orderBy('id', 'desc')->first();
        $sameCate = Book::where('category_id', '=', $n->categories->id)->whereNotIn('id', [$n->id])->orderBy('id', 'desc')->get();
        $sidebarFeatureBooks = Book::where('hot_book', '=', 1)->orderBy('id', 'desc')->take(5)->get();
        $FeatureBooks = Book::where('hot_book', '=', 2)->orderBy('id', 'desc')->take(5)->get();
        $NewBooks = Book::where('hot_book', '=', 0)->orderBy('id', 'desc')->take(5)->get();
        $bookviews = Book::findOrFail($n->id);
        $view = session()->get('views');
        if(Cookie::get($n->id)!=''){
            Cookie::set('$n->id', '1', 60);
            $bookviews->incrementReadCount();
        }
        if($view == null){
            session()->put('views', 1); //set giá trị cho session view
            $bookviews->increment('views');
        }else if($view != null){
            $bookviews->increment('views');
        }
        return view('home.pages.book', [
            'title' => $n->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => $n,
            'chapters' => $chapter,
            'update_chapter' => $update_chapter,
            'sameCate' => $sameCate,
            'oneChapter' => $oneChapter,
            'lastChapter' => $lastChapter,
            'sidebarFeatureBooks' => $sidebarFeatureBooks,
            'FeatureBooks' => $FeatureBooks,
            'NewBooks' => $NewBooks
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
            'cateb' => $cateb,
            'books' => $n
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

            if($book == true){
                foreach ($book as $b){
                    $html .= "<li class='dropdown-item'>
                        <a style='text-decoration: none;' href='". route('doc-truyen', ['slug'=>$b->slug]) ."'>". $b->name . "</a>
                    </li>";
                }
            }else if($data['keywords'] == ''){
                $html .= "<li class='dropdown-item'>
                <a style='text-decoration: none;' href=''>Không Tìm Thấy</a>
                </li>";
            }
            $html .= "</ul>";
        }
        return Response($html);
    }
}
