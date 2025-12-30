<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'email',
        'name',
    ];

    /**
     * Check if an email is registered as admin
     */
    public static function isAdmin(string $email): bool
    {
        return static::where('email', $email)->exists();
    }
}
