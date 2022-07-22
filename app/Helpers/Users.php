<?php

namespace App\Helpers;

use App\Models\Socialmedia;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class Users
{
    /**
     * @param $image
     * @return string
     */
    public static function getAvatar($image) {
        if ( $image === 'noavatar.png') {
            $file = file_get_contents(public_path('img/noavatar.png'));
            $type = File::mimeType(public_path('img/noavatar.png'));
        } else {
            $exists = Storage::disk('public')->exists('avatar/' . $image);

            if (!$exists) {
                $file = file_get_contents(public_path('img/noavatar.png'));
                $type = File::mimeType(public_path('img/noavatar.png'));
            } else {
                $file = Storage::get('public/avatar/' . $image);
                $type = Storage::disk('public')->mimeType('avatar/' . $image);
            }
        }
        return 'data:'.$type.';base64,' .base64_encode($file);
    }

    /**
     * @param $id
     */
    public static function syncSocialMedia($id) {
        $getUser = User::find($id);

        $data_array = [];
        if ( request()->filled('socmed') ) {
            foreach ( request('socmed') as $item ) {
                $socmed_id = $item;
                $socmed = Socialmedia::find($item);

                if (request($socmed->slug) != null) {
                    $data_array[$item] = [ 'url' => request($socmed->slug) ];
                }
            }
            $getUser->socialmedia()->sync($data_array);
        }
    }
}
