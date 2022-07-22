<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    /**
    * A permission can be applied to roles.
    */

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }
}
