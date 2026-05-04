<?php

namespace App\Helpers;

use Auth;
use File;

class GenericHelperClass
{
    /**
     * @author Umar Naveed
     *
     * This class is a generic form of method which are to be used all around the
     * project, for reusability and static behaviour by laravel facades
     *
     * Write down all the generic methods here in this class for flexibility and reusability
     * Please note this class will be autoloaded via composer and injected to the service
     * providers.
     */

    public function sendResponseBack($data, String $index, String $sucessMsg = null, String $errorMsg = null)
    {
        try {

            if (!empty($data)) {
                return response()->json([
                    'status' => 200,
                    'success' => $sucessMsg,
                    $index => $data,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'success' => $errorMsg,
                    $index => $data,
                ], 404);
            }
            //code...
        } catch (\Exception$e) {
            //throw $th;
            return response()->json([
                'error' => $e->getMessage(),
                $index => $data,
            ], 401);
        }

    }
    public function saveImage($image, $imgpath, $extension=null)
    {
        if($extension){
            $fileName = time().'.'.$extension;
        }else{
            $fileName = time().'.'.$image->clientExtension();
        }
        $image->move($imgpath, $fileName);
        $profilePhoto = $fileName;
        return $profilePhoto;
    }
    public function updateImage($image ,$dbrecord, $imgpath)
    {
        $getimagePath = $this->checkImagePath($imgpath);
        if(empty($image)) {
            $profilePhoto = $dbrecord;
        } else {
            $imagePath =  $getimagePath.$dbrecord;
            if(File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $destinationPath = $getimagePath;
            $file = $image;
            $fileName = time().'.'.$file->clientExtension();
            $file->move($destinationPath, $fileName);
            $profilePhoto = $fileName;
        }
        return $profilePhoto;

    }

    public function checkImagePath($imagegpath)
    {
        if(Auth::check()){
            if(Auth::user()->type == 1) {
                $imgpath = $imagegpath;
                $this->makeNewDirectory($imgpath);
             } elseif(Auth::user()->type == 2) {
                 $imgpath = public_path('frontend/director/');
                 $this->makeNewDirectory($imgpath);
             } elseif(Auth::user()->type == 3) {
                 $imgpath = public_path('frontend/coach/');
                 $this->makeNewDirectory($imgpath);
             } elseif(Auth::user()->type == 4) {
                $imgpath = $imagegpath;
                $this->makeNewDirectory($imgpath);
             }
        }else{
            $imgpath = public_path('frontend/player/');
            $this->makeNewDirectory($imgpath);
        }
        return $imgpath;

    }

    public function makeNewDirectory($imgpath)
    {
        if(!File::isDirectory($imgpath)){
            File::makeDirectory($imgpath, 0777, true, true);
        }
    }
}
