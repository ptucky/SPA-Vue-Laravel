<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ImagesController extends Controller
{
    public function upload(Request $request)
    {
        $imageNameArr = [];
        if (count($request->images)) {
        //if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $imageName = $image->getClientOriginalName();
                $imageNameNew = date('YmdHis').strtolower($imageName);
                $imageNameArr[] = $imageNameNew;
                
                // Uplaod into storage in uiser_id folder
                $image->storeAs('public/'.$request->user_id.'/', $imageNameNew); 
                #$image->store('public'); 
                #$image->store('images');
            }
        }

        return response()->json([
            "image_name_arr" => $imageNameArr,
            "message" => "Success"
        ]);
    }
}
