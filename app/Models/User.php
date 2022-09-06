<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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

    /* 顯示所有成員 */
    public function members()
    {
        return $this->hasMany(UserMember::class)
                    ->with('workbatch')
                    ->whereNull('deleted_at')
                    ->select('id', 'user_id', 'user_workbatch_id', 'name', 'role', 'account', 'email');
    }

    /* 顯示所有區域 */
    public function regions()
    {
        return $this->hasMany(UserRegion::class)->whereNull('deleted_at');
    }

    /* 顯示所有設備 */
    public function devices()
    {
        return $this->hasMany(UserDevice::class)
                    ->with('region')
                    ->with('device')
                    ->whereNull('deleted_at');
    }
}
