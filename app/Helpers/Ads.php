<?php

namespace App\Helpers;

use App\Models\Adspace;

class Ads
{
    /**
     * @param $space
     * @return mixed
     */
    public static function checkAd($space) {
        return Adspace::whereSlug($space)->first()->ad()->exists();
    }

    /**
     * @param $space
     * @return mixed
     */
    public static function checkActive($space) {
        return Adspace::whereSlug($space)->first()->ad->active;
    }

    /**
     * @param $space
     * @return mixed
     */
    public static function checkNewsActive($space) {
        return Adspace::whereSlug($space)->first()->ad->news_active;
    }

    /**
     * @param $space
     * @return mixed
     */
    public static function checkScript($space) {
        return Adspace::whereSlug($space)->first()->ad->script;
    }

    /**
     * @param $space
     * @return string
     */
    public static function adUrl($space) {
        if (self::checkAd($space)) {
            $adspace = Adspace::whereSlug($space)->first();
            return $adspace->ad->url;
        } else {
            return '#';
        }
    }

    /**
     * @param $space
     * @return string
     */
    public static function adLabel($space) {
        if (self::checkAd($space)) {
            $adspace = Adspace::whereSlug($space)->first();
            return $adspace->ad->label;
        } else {
            return 'Noimage';
        }
    }

    /**
     * @param $space
     * @return string
     */
    public static function adImage($space) {
        if (self::checkAd($space)) {
            $adspace = Adspace::whereSlug($space)->first();
            $image = $adspace->ad->image;
        } else {
            $image = 'noimage';
        }

        return route('image.AdDisplayImage', $image);
    }

    /**
     * @param $space
     * @return mixed
     */
    public static function checkAdImage($space) {
        $adspace = Adspace::whereSlug($space)->first();
        return $adspace->ad->image;
    }

}
