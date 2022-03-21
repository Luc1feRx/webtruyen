<?php

namespace App\Http\Controllers\Admin\Chapter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chapter\ChapterRequest;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.chapter.index', [
            'title' => 'Danh Sách Chapter',
            'name' => session()->get('email'),
            'chapters' => Chapter::with('books')->orderBy('id', 'desc')->simplePaginate(15)
        ]);
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
            $request->except('_token');
            Chapter::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'book_id' => $request->input('book_id'),
                'active' => $request->input('active')
            ]);
            session()->flash('success', 'Thêm Chapter Thành Công');
            return redirect()->route('chapters.create');
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
    public function update(ChapterRequest $request, $id)
    {
        try{
            $request->except('_token');
            $chapter = Chapter::findOrFail($id);
            $chapter->name = $request->input('name');
            $chapter->slug = $request->input('slug');
            $chapter->description = $request->input('description');
            $chapter->content = $request ->input('content');
            $chapter->book_id = $request ->input('book_id');
            $chapter->active = $request->input('active');
            $chapter->save();
            session()->flash('success', 'Cập Nhật Chapter Thành Công');
            return redirect()->route('chapters.index');
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
        //
    }
}
