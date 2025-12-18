<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UploadController extends Controller
{
    public function ckeditorUpload(Request $request)
    {
        try {
            $request->validate([
                'upload' => 'nullable|image|max:2048',
            ]);
            
            $folder = $request->get('folder', 'general');
            $file = $request->file('upload');

            $filename = 'ck_' . time() . '.webp';
            $image = Image::read($file)
                ->scaleDown(width: 800)
                ->toWebp(quality: 50);

            // Simpan
            Storage::disk('public')->put("ckeditor/$folder/$filename", (string)$image);

            // URL untuk CKEditor
            $url = asset("storage/ckeditor/$folder/$filename");

            return response()->json([
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ['message' => $e->getMessage()]
            ], 400);
        }
    }
}
