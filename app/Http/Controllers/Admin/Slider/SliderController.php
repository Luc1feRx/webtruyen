<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return view('admin.slider.index', [
            'title' => 'Danh Sách Slider',
            'sliders' => $sliders,
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
        return view('admin.slider.add', [
            'title' => 'Thêm Mới Slider',
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

        $slider = new Slider();
        $slider->name = $request->name;
        $slider->slug = $request->slug;
        $slider->description = $request->description;
        $fileName = "";
        if($request->hasFile('thumb')){
            $fileName = $request->file('thumb')->store('images', 'public');
            $path = 'storage/' . $fileName;
        }else{
            $fileName = Null;
        }
        $slider->image = $path;
        $slider->active = $request->active;
        $slider->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        if($slider->save()){
            return response()->json([
                'slider' => $slider,
                'code' => 200,
                'message' => 'Add Success'
            ]);
        }else{
            return response()->json([
                'message' => 'Add Failure'
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
    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('admin.slider.edit', [
            'title' => 'Cập Nhật Slider',
            'sliders' => $sliders,
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
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:300'
        ]);
        $slider->name = $request->name;
        $slider->slug = $request->slug;
        $slider->description = $request->description;
        $fileName = "";
        if($request->hasFile('thumb')){
            $fileName = $request->file('thumb')->store('images', 'public');
            $path = 'storage/' . $fileName;
        }else{
            $fileName = Null;
        }
        $slider->image = $path;
        $slider->active = $request->active;
        $slider->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if($slider->save()){
            return response()->json([
                'slider' => $slider,
                'code' => 200,
                'message' => 'Update Success'
            ]);
        }else{
            return response()->json([
                'message' => 'Update Failure'
            ]);
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
            $slider = Slider::where('id', $request->id)->first();
            if($slider){
                $slider->delete();
                $sliderImage = str_replace('/storage/images/', '', $slider->image);
                if(Storage::disk('public')->exists('images/' . $sliderImage)){
                    Storage::disk('public')->delete('images/' . $sliderImage);
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
