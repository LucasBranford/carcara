<?php

namespace App\Custom\Adminlte;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
 
use Laratrust\LaratrustFacade as Laratrust;

class RoleFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['role']) && ! Laratrust::hasRole($item['role'])) {
            $item['restricted'] = true;
        }

        return $item;
    }
}