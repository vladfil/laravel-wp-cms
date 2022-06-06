<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, $filters)
    {
        if ($filters['s'] ?? false) {
            $query->where('name', 'like', '%' . $filters['s'] . '%');
        }
    }

    public function getMenuList()
    {
        $menuList = [
            [
                'uri' => '/admin/users',
                'icon' => 'fa-users',
                'label' => 'Users',
            ],
            [
                'uri' => '/admin/images',
                'icon' => 'fa-images',
                'label' => 'Images',
            ],
            [
                'uri' => '/admin/posts',
                'icon' => 'fa-newspaper',
                'label' => 'Posts',
            ],
            [
                'uri' => '/admin/settings',
                'icon' => 'fa-gears',
                'label' => 'User Settings',
            ],
            [
                'uri' => '/logout',
                'icon' => 'fa-arrow-right-from-bracket',
                'label' => 'Logout',
            ],
        ];

        return $menuList;
    }
}
