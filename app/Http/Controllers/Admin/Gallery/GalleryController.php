<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'desc')->paginate(10);
        return view('admin.gallery.index', [
            'title' => 'Danh Sách gallery',
            'galleries' => $galleries,
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
        return view('admin.gallery.add', [
            'title' => 'Thêm Mới Gallery',
            'name' => session()->get('email')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:300'
        ]);

        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->slug = $request->slug;
        $fileName = "";
        if($request->hasFile('thumb')){
            $fileName = $request->file('thumb')->store('images', 'public');
            $path = 'storage/' . $fileName;
        }else{
            $fileName = Null;
        }
        $gallery->image = $path;
        $gallery->description = $request->description;
        $gallery->active = $request->active;
        $gallery->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        if($gallery->save()){
            // return response()->json([
            //     'slider' => $gallery,
            //     'code' => 200,
            //     'message' => 'Add Success'
            // ]);
        }else{
            // return response()->json([
            //     'message' => 'Add Failure'
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', [
            'title' => 'Cập Nhật Slider',
            'gallery' => $gallery,
            'name' => session()->get('email')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:300'
        ]);
        $gallery->name = $request->name;
        $gallery->slug = $request->slug;
        $gallery->description = $request->description;
        $fileName = "";
        $destination = $gallery->image;
        if($request->hasFile('thumb')){
            if(File::exists($destination)){
                File::delete($destination);
            }
            $fileName = 'storage/'. $request->file('thumb')->store('images', 'public');
            // $fileName = $request->file('thumb')->store('images', 'public');
        }else{
            $fileName = 'storage/'.$request->image;
        }
        $gallery->image = $fileName;
        $gallery->active = $request->active;
        $gallery->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if($gallery->save()){
            // return response()->json([
            //     'gallery' => $gallery,
            //     'code' => 200,
            //     'message' => 'Update Success'
            // ]);
        }else{
            // return response()->json([
            //     'message' => 'Update Failure'
            // ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $gallery = Gallery::where('id', $request->id)->first();
            if($gallery){
                $gallery->delete();
                $galleryImage = str_replace('/storage/images/', '', $gallery->image);
                if(Storage::disk('public')->exists('images/' . $galleryImage)){
                    Storage::disk('public')->delete('images/' . $galleryImage);
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
}
