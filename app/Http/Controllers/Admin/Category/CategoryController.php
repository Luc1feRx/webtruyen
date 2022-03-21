<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'title' => 'Danh Sách Danh Mục',
            'name' => session()->get('email'),
            'categories' => Category::orderBy('id', 'desc')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add', [
            'title' => 'Thêm Mới Danh Mục',
            'name' => session()->get('email')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) // them danh muc
    {
        try{
            $request->except('_token');
            Category::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'active' => $request->input('active')
            ]);
            session()->flash('success', 'Thêm Danh Mục Thành Công');
            return redirect()->route('category.create');
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
        return view('admin.category.edit', [
            'title' => 'Cập Nhật Danh Mục',
            'categories' => Category::find($id),
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
    public function update(CategoryRequest $request, $id)
    {
        try{
            $request->except('_token');
            $cate = Category::find($id);
            $cate->name = $request->input('name');
            $cate->slug = $request->input('slug');
            $cate->description = $request->input('description');
            $cate->active = $request->input('active');
            $cate->save();
            session()->flash('success', 'Cập Nhật Danh Mục Thành Công');
            return redirect()->route('category.index');
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
            Category::findOrFail($id)->delete();
            session()->flash('success', 'Xóa Thành Công');
            return redirect()->route('category.index');
        }catch(\Exception $e){
            session()->flash('error', $e);
        }
    }
}
