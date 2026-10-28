<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\HasRolesAndPermissions;
use Laratrust\Contracts\LaratrustUser;

use function PHPSTORM_META\map;

class User extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions;                // no lugar de "use LaratrustUserTrait;"
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->addRole(config('user'));
        });
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'name',
        'email',
        'password',
        'matricula',
        'telefone',
        'team_id',
        'unidade_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
