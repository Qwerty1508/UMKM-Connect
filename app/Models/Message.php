<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'content',
        'attachment',
        'is_from_seller'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
