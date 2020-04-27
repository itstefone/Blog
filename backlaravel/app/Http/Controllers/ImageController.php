<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use UploadTrait;


    public function uploadProfileImage(Request $request) {


        $imageName = $this->uploadOne($request->image, 'tmpPhotos');

        return response()->json([
                'imageName' => $imageName
        ]);
    }
}
