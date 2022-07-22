<?php

namespace App\Helpers;


class SponsorVideo
{

    /**
     * @param $space
     * @return mixed
     */
    public static function checkActive()
    {
        return \App\Models\SponsorVideo::first()->active;
    }

    /**
     * @param $space
     * @return string
     */
    public static function editionLabel()
    {
        if (self::checkSponsorVideo()) {
            return \App\Models\SponsorVideo::first()->label;
        } else {
            return 'Sponsor';
        }
    }

    /*
     * @param $space
     * @return mixed
     */
    public static function checkSponsorVideoURL()
    {
        return \App\Models\SponsorVideo::first()->youtube_id;
    }


    /*
     * @param $space
     * @return mixed
     */
    public static function SponsorVideoUrl()
    {
        return \App\Models\SponsorVideo::first()->youtube_id;
    }


    /**
     * @param $space
     * @return mixed
     */
    public static function checkSponsorVideo()
    {
        return \App\Models\SponsorVideo::exists();
    }

}
