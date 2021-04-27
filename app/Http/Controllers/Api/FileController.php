<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function uploadCropImage(Request $request)
    {
        if(isset($request->image))
        {
            $path = $request->url;

            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = Str::uuid() . '.png';

            $fullPath = $path . $filename;
            Storage::disk('s3')->put($fullPath, $image_base64, 'public');

            return response()->json([
                'url' => $fullPath,
                'data' => Storage::disk('s3')->url($fullPath)
            ], 200);
        }

        return response()->json([], 400);
    }
}
