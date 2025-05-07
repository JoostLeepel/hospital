<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Relatie met de roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Controleer of de gebruiker een specifieke rol heeft
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
}

