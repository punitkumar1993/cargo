<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Settings
{
    /**
     * @param $name
     * @return mixed
     */
    public static function check($name){
        return $get_settings = Setting::where('name', $name)->exists();
    }

    /**
     * @param $name
     * @return |null
     */
    public static function get($name)
    {
        $get_settings = Setting::get();
        if(self::check($name)){
            return $get_settings->whereIn('name', $name)->first()->value;
        }else{
            return NULL;
        }
    }

    /**
     * @param $dir
     * @return mixed
     */
    public static function get_theme($dir)
    {
        $content = File::get(public_path('themes/'.$dir.'/theme.json'));
        return json_decode($content, true);
    }

    /**
     * @param $arr
     * @return array|\ArrayAccess|mixed
     */
    public static function theme_name($arr)
    {
        return Arr::get($arr, 'theme_name');
    }

    public static function get_data_theme($arr, $key)
    {
        return Arr::get($arr, $key);
    }

    /**
     * @param $page
     * @return string
     */
    public static function active_theme($page)
    {
        $theme_dir = self::get('current_theme_dir');
        if(File::exists(public_path('themes/'.$theme_dir.'/theme.json'))){
            return 'frontend.'.$theme_dir.'.'.$page;
        }else{
            return 'frontend.magz.page.home';
        }
    }

    /**
     * @param $path_asset
     * @return string
     */
    public static function theme($path_asset)
    {
        $theme_dir = self::get('current_theme_dir');
        return asset('themes/'.$theme_dir.'/'.$path_asset);
    }

    public static function getRoutePost($post)
    {
        if (Schema::hasTable('settings')) {
            if(Settings::get('permalink')) {
                $year = $post->created_at->format('Y');
                $month = $post->created_at->format('m');
                $day = $post->created_at->format('d');

                if(Settings::get('permalink') == "%year%/%month%/%day"){
                    return route('article.show', compact('post','year', 'month', 'day'));
                }elseif(Settings::get('permalink') == "%year%/%month%"){
                    return route('article.show', compact('post','year', 'month'));
                }elseif(Settings::get('permalink') == "post_name"){
                    return route('article.show', compact('post'));
                }else{
                    return route('article.show', compact('post'));
                }
            }else{
                abort(404);
            }
        }
    }
    public static function getRouteEvent($post)
    {
        if (Schema::hasTable('settings')) {
            if(Settings::get('permalink')) {
                $year = $post->created_at->format('Y');
                $month = $post->created_at->format('m');
                $day = $post->created_at->format('d');
                if(Settings::get('permalink') == "%year%/%month%/%day"){
                    return route('event.show', compact('post','year', 'month', 'day'));
                }elseif(Settings::get('permalink') == "%year%/%month%"){
                    return route('event.show', compact('post','year', 'month'));
                }elseif(Settings::get('permalink') == "post_name"){
                    return route('event.show', compact('post'));
                }else{
                    return route('event.show', compact('post'));
                }
            }else{
                abort(404);
            }
        }
    }

    /**
     * Get the route of MRO
     *
     * @param $post
     * @return string
     */
    public static function getRouteMro($post)
    {
        if (Schema::hasTable('settings')) {
            if(Settings::get('permalink')) {
                $year = $post->created_at->format('Y');
                $month = $post->created_at->format('m');
                $day = $post->created_at->format('d');
                if(Settings::get('permalink') == "%year%/%month%/%day"){
                    return route('mros.show', compact('post','year', 'month', 'day'));
                }elseif(Settings::get('permalink') == "%year%/%month%"){
                    return route('mros.show', compact('post','year', 'month'));
                }elseif(Settings::get('permalink') == "post_name"){
                    return route('mros.show', compact('post'));
                }else{
                    return route('mros.show', compact('post'));
                }
            }else{
                abort(404);
            }
        }
    }

    /**
     * check_connection
     *
     * @return void
     */
    public static function check_connection()
    {
        $host_name = 'www.google.com';
        $port_no = '80';
        return (bool)@fsockopen($host_name, $port_no, $err_no, $err_str, 10);
    }

    public static function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


}
