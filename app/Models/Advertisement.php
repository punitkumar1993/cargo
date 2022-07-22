<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'space_id', 'label', 'url', 'image', 'size', 'image', 'script'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function space()
    {
        return $this->belongsTo('App\Models\Adspace', 'space_id', 'id');
    }
}
