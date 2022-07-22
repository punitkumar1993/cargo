<?php

namespace App\Helpers;


class LatestEdition
{

    /**
     * @param $space
     * @return mixed
     */
    public static function checkActive()
    {
        return \App\Models\LatestEdition::first()->active;
    }

    /**
     * @param $space
     * @return string
     */
    public static function editionLabel()
    {
        if (self::checkEdition()) {
            return \App\Models\LatestEdition::first()->label;
        } else {
            return 'Noimage';
        }
    }

    /*
     * @param $space
     * @return mixed
     */
    public static function checkEditionImage()
    {
        return \App\Models\LatestEdition::first()->image;
    }


    /**
     * @param $space
     * @return string
     */
    public static function editionUrl()
    {
        if (self::checkEdition()) {
            return \App\Models\LatestEdition::first()->url;
        } else {
            return '#';
        }
    }

    /**
     * @param $space
     * @return string
     */
    public static function editionImage()
    {
        if (self::checkEdition()) {
            return route('image.EditionDisplayImage', \App\Models\LatestEdition::first()->image);
                ;
        } else {
            $image = 'noimage';
        }

        return route('image.AdDisplayImage', $image);
    }


    /**
     * @param $space
     * @return mixed
     */
    public static function checkEdition()
    {
        return \App\Models\LatestEdition::exists();
    }

}
