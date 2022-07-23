<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Magazine extends Model
{
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'file',
        'image',
        'description',
        'hightlight_one',
        'hightlight_two',
        'hightlight_three',
        'hightlight_four',
        'hightlight_five',
        'hightlight_six',
     ];


    /**
     * Upload magazine file
     *
     * @param $image
     * @return string
     */
    public static function uploadPdfFile($request, $fileName) {

        $path = storage_path('app/public/magazines');

        if ($request->hasFile($fileName)) {
            $file = $request->file($fileName);
            // File Details
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath  = $file->getRealPath();
            $fileSize  = $file->getSize();
            $mimeType  = $file->getMimeType();
            $fileName = uniqid() . time().'_'.$filename;

            Storage::disk('public')->put( 'magazines/' . $fileName, file_get_contents($file));

            return $fileName;
        }
    }

}
