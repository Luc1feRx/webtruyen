<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request){
        $url = $this->upload($request);
        if($url != false){
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function upload(Request $request){
        if($request->hasFile('file')){
            try {
                $name = $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs(
                    'public/uploads/' , $name
                );

                return '/webtruyen/storage/app/public/uploads/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}
