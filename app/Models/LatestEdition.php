<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestEdition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label', 'url', 'image', 'active'
    ];
}
