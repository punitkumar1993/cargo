<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adspace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ad()
    {
        return $this->hasOne('App\Models\Advertisement', 'space_id', 'id');
    }
}
