<?php

namespace App\Custom\Adminlte;


use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class TeamFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['team']) && !Auth::user()->isAbleTo($item['team'])) {
            return false;
        }

        return $item;
    }
}
