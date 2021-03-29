<?php

function uploadCropImage($image, $fullPath)
{
    if(isset($image))
    {
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        Illuminate\Support\Facades\Storage::disk('s3')->put($fullPath, $image_base64, 'public');

        return response()->json(['data' => Illuminate\Support\Facades\Storage::disk('s3')->url($fullPath)], 200);
    }

    return response()->json([], 400);
}
