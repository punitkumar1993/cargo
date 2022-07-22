<?php

namespace App\Helpers;

use App\Models\Magazine;

class Magazines
{
    /**
     * @return mixed
     */
    public static function magazineCount()
    {
        return Magazine::count();
    }
}
