<?php

namespace App\Helpers;

use Spatie\Permission\Models\Permission;

class Permissions
{
    /**
     * @param $id
     * @return mixed
     */
    public static function get($id)
    {
        return Permission::where('group_id',$id)->get();
    }
}
