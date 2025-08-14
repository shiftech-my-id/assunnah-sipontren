<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    public const Role_Admin = 'admin';
    public const Role_Teacher = 'teacher';
    public const Role_HeadMaster = 'headmaster';

    // Display role di hardcode saja, tidak diambil dari translations
    public const Roles = [
        self::Role_Admin => 'Administrator',
        self::Role_Teacher => 'Guru',
        self::Role_HeadMaster => 'Kepala Sekolah',
    ];

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'active',
        'is_root',
        'last_login_datetime',
        'last_activity_description',
        'last_activity_datetime'
    ];

    protected $casts = [
        'is_root' => 'boolean',
        'active' => 'boolean',
        'last_login_datetime' => 'datetime',
        'last_activity_datetime' => 'datetime',
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
            'password' => 'hashed',
        ];
    }

    public function setLastLogin()
    {
        $this->last_login_datetime = now();
        $this->save();
    }

    public function setLastActivity($description)
    {
        $this->last_activity_description = $description;
        $this->last_activity_datetime = now();
        $this->save();
    }

    public function groups()
    {
        return $this->belongsToMany(UserGroup::class, 'users_has_groups');
    }
}
