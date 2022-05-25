<?php

namespace App\Http\Controllers\Admin\Chapter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chapter\ChapterRequest;
use App\Models\Book;
use App\Models\Chapter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    public function index()
    {
        $chapter = Chapter::with('books')->orderBy('id', 'desc')->simplePaginate(15);
        return view('admin.chapter.index', [
            'title' => 'Danh Sách Chapter',
            'name' => session()->get('email'),
            'chapters' => $chapter
        ]);

        // return response()->json([
        //     'chapters' => $chapter,
        //     'status' => 200
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chapter.add', [
            'title' => 'Thêm Chapter Mới',
            'name' => session()->get('email'),
            'books' => Book::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterRequest $request)
    {
        try{
            $chapter = new Chapter();
            $chapter->name = $request->name;
            $chapter->slug = $request->slug;
            $chapter->description = $request->description;
            $chapter->content = $request->content;
            $chapter->book_id = $request->book_id;
            $chapter->active = $request->active;
            $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            if($chapter->save()){
                return response()->json([
                    'chapters' => $chapter,
                    'message' => 'Chapter add successfully',
                    'status' => 200
                ]);
            }
            // session()->flash('success', 'Thêm Chapter Thành Công');
            // return redirect()->route('chapters.create');
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
        return  view('admin.chapter.edit', [
            'title' => 'Cập Nhật Chapter',
            'books' => Book::orderBy('id', 'desc')->get(),
            'chapters' => Chapter::findOrFail($id),
            'name' => session()->get('email')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterRequest $request, Chapter $chapter)
    {
        try{
            $request->except('_token');
            $chapter->name = $request->name;
            $chapter->slug = $request->slug;
            $chapter->description = $request->description;
            $chapter->content = $request ->content;
            $chapter->book_id = $request ->book_id;
            $chapter->active = $request->active;
            $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            if($chapter->save()){
                return response()->json([
                    'chapters' => $chapter,
                    'message' => 'Chapter update successfully',
                    'status' => 200
                ]);
            }
            // session()->flash('success', 'Cập Nhật Chapter Thành Công');
            // return redirect()->route('chapters.index');
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
        $chapter = Chapter::where('id', $request->id)->first();
        if($chapter){
            $chapter->delete();
            return response()->json([
                'success' => 'Delete Success',
                'status' => 200
            ]);
        }
    }
}
