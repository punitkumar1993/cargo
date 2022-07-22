<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'name', 'username', 'email', 'password', 'about', 'photo', 'occupation', 'organization', 'image'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function socialmedia()
    {
        return $this->belongsToMany('App\Models\Socialmedia', 'user_socialmedia', 'user_id', 'socialmedia_id')
        ->withTimestamps()
        ->withPivot('url');
    }

    /**
     * @return string
     */
    public function adminlte_image()
    {
        if (Auth::user()->photo) {
            if (Auth::user()->photo != 'noavatar.png') {
                return route('profile.photo', Auth::user()->photo);
            } else {
                return asset('img/noavatar.png');
            }
        } else {
            return asset('img/noavatar.png');
        }
    }

    /**
     * @return string
     */
    public function adminlte_desc()
    {
        foreach (Auth::user()->getRoleNames() as $role) {
            $roles[] = $role;
        }
        return implode(' ', $roles);
    }

    /**
     * @return string
     */
    public function adminlte_profile_url()
    {
        return 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/profile';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param Builder $query
     * @param $roles
     * @param null $guard
     * @return Builder
     */
    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (! is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
        }, $roles);

        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->where(function ($query) use ($roles) {
                foreach ($roles as $role) {
                    $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
                }
            });
        });
    }
}
