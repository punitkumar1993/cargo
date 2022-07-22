<?php

namespace App\Traits;

use Harimayco\Menu\Facades\Menu;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

trait MenuTrait
{
    public function buildMenu($menuList, $is_sub = false)
    {
        $ulclass = (!$is_sub) ? 'nav-list' : 'dropdown-menu';
        $menu = "<ul class='$ulclass'>n";

        foreach ($menuList as $id => $properties) {

            foreach ($properties as $key => $val) {

                if (is_array($val)) {
                    $sub = buildMenu($val, TRUE);
                } else {
                    $sub = null;
                    $$key = $val;
                }
            }
        }

        return $menu . "</ul>n";
    }
}
