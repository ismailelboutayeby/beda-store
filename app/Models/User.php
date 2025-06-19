<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
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

    /**
     * Get the orders for the user (as a client).
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    /**
     * Get the production tasks assigned to the user.
     */
    public function productionTasks()
    {
        return $this->hasMany(ProductionTask::class, 'assigned_to');
    }

    /**
     * Get the shipments assigned to the user (if applicable).
     */
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The permissions that belong to the user.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
