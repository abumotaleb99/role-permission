<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getPermissionGroups()
    {
        $permissionGroups = Permission::select('group_name as name')
            ->groupBy('group_name')
            ->orderBy('id', 'asc')
            ->get();

        return $permissionGroups;
    }

    public static function getPermissionsByGroupName($groupName)
    {
        $permissions = Permission::select('name', 'id')
            ->where('group_name', $groupName)
            ->get();

        return $permissions;
    }

    public static function roleHasAllPermissions($role, $permissions)
    {
        $hasAllPermissions = true;

        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasAllPermissions = false;
                return $hasAllPermissions;
            }
        }

        return $hasAllPermissions;
    }
}
