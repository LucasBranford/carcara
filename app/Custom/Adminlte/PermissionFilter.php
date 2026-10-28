<?php

namespace App\Custom\Adminlte;


use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['permission']) && !Auth::user()->isAbleTo($item['permission'])) {
            return false;
        }

        return $item;
    }
}
