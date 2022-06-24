<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $cate = Category::orderBy('id', 'desc')->paginate(15);
        return view('admin.category.index', [
            'title' => 'Danh Sách Danh Mục',
            'name' => session()->get('email'),
            'categories' => CategoryResource::collection($cate)
        ]);
    }

    public function GetAllCategory()
    {
        $cate = Category::orderBy('id', 'desc')->paginate(15);
        return CategoryResource::collection($cate);
    }

    public function create()
    {
        return view('admin.category.add', [
            'title' => 'Thêm Mới Danh Mục',
            'name' => session()->get('email')
        ]);
    }

    public function store(CategoryRequest $request) // them danh muc
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug =  $request->slug;
        $category->description = $request->description;
        $category->active = $request->active;
        if($category->save()){
            return response()->json([
               'message' => 'Add Success',
               'code' => 200
            ]);
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'title' => 'Cập Nhật Danh Mục',
            'categories' => $category,
            'name' => session()->get('email')
        ]);
        // return response()->json([
        //     'cate' => $cate,
        //     'code' => 200
        // ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try{
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->description = $request->description;
            $category->active = $request->active;
            if($category->save()){
                return response()->json([
                    'message' => 'Update Success',
                    'code' => 200
                ]);
            }
        }catch(\Exception $e){
            session()->flash('error', $e);
        }
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        if($category){
            $category->delete();
            return response()->json([
                'message' => 'Delete Success',
                'status' => 200
            ]);
        }
    }
}
