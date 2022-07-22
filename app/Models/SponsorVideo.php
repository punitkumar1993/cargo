<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorVideo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label', 'url', 'youtube_id', 'active'
    ];
}
