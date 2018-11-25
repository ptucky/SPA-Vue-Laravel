<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Validator;
use Log;

use App\User;    //Model
use App\Gallery; //Model

class UserController extends Controller
{

    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        
        $user = User::create($input);

        $success = [
            'user' => $user,
            //'token' => $user->createToken('bigStore')->accessToken,
        ];
        
        return response()->json($success);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserGallery($userId){
        $rs = [];
        if(isset($userId)){
            $rs = Gallery::where('user_id','=',$userId)
                        ->orderBy('id','desc')
                        ->get();
        } 

        return $rs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUserGallery(Request $request){
        if($request->user_id){
            $gallery = new Gallery();
            foreach ($request->image_name_arr as $image) {
                $data[] = [
                            'image_name' => $image,
                            'user_id' => $request->user_id
                          ];
            }
        
            #\Log::info($data);
            $gallery->insert($data);
    
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string
     * @return \Illuminate\Http\Response
     */
    public function deleteUserGallery($id,$userId)
    {
        if($id > 0 && $userId > 0){
            $gallery = Gallery::where('user_id', $userId)->findOrFail($id);
            
            if($gallery){
                $destinationPath = 'storage/'.$userId.'/'; 
                File::delete($destinationPath.$gallery['image_name']);
                
                $gallery->delete();
            }

            return 'Success';
        }
    }

    /**
     * Disk Space
     * return array
     */
    public function getDiskUsage($userId){
        
        if($userId > 0){
            
            $diskSpace = "0.00";
            $file_size = "0";
            $key = "0";
            $extensions = [];
            $dir = "storage/".$userId;

            if(is_dir($dir)){
                foreach(File::allFiles("storage/".$userId."/") as $file)
                {
                    $getExtension = explode(".", $file);

                    if(isset($getExtension[1])){
                        if($getExtension[1] == 'jpg' || $getExtension[1] == 'jpeg'){
                            $extensions['jpg'][] = $file->getSize();
                        } else if($getExtension[1] == 'png'){
                            $extensions['png'][] = $file->getSize();
                        }
                    }   

                    $file_size += $file->getSize();
                    $key ++;
                }

                $diskSpace = number_format($file_size / 1048576,2);
            }
            

            if (isset($extensions['jpg'])) {
                $file_jpg = count($extensions['jpg']);
                $file_jpg_size = array_sum($extensions['jpg']);
            } else {
                $file_jpg = "0";
                $file_jpg_size = "0";
            }

            if (isset($extensions['png'])) {
                $file_png = count($extensions['png']);
                $file_png_size = array_sum($extensions['png']);
            } else {
                $file_png = "0";
                $file_png_size = "0";
            } 
        
            $arrDisk = [
                'b' => $file_size,
                'mb' => $diskSpace,
                'no_file' => $key,
                'jpg' => $file_jpg,
                'png' => $file_png,
                'jpg_size' => $file_jpg_size,
                'png_size' => $file_png_size
            ];
            
            return $arrDisk;
        }

    }

}